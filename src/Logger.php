<?php
/**
 * Logger - Audit trail logging system
 * Ghi lại tất cả hành động admin để tracking
 */

class Logger {
    private static $instance = null;
    private $logDir = __DIR__ . '/../logs';
    private $dbConnection = null;

    private function __construct() {
        $this->ensureLogDirectory();
        $this->dbConnection = Database::getConnection();
    }

    /**
     * Singleton instance
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Log action to file and database
     */
    public function log($action, $details = [], $severity = 'INFO') {
        $adminId = $_SESSION['admin_id'] ?? 0;
        $adminName = $_SESSION['admin_name'] ?? 'Unknown';
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'admin_id' => $adminId,
            'admin_name' => $adminName,
            'action' => $action,
            'details' => json_encode($details),
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'severity' => $severity,
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
            'uri' => $_SERVER['REQUEST_URI'] ?? 'CLI',
        ];

        // Log to file
        $this->logToFile($logData);

        // Log to database (if needed)
        $this->logToDatabase($logData);
    }

    /**
     * Log specific actions
     */
    public function logLogin($success = true) {
        $action = $success ? 'LOGIN_SUCCESS' : 'LOGIN_FAILED';
        $severity = $success ? 'INFO' : 'WARNING';
        
        $this->log($action, [
            'username' => $_POST['username'] ?? 'Unknown'
        ], $severity);
    }

    public function logLogout() {
        $this->log('LOGOUT', []);
    }

    public function logCreate($entity, $id, $data = []) {
        $this->log("CREATE_{$entity}", array_merge(['id' => $id], $data), 'INFO');
    }

    public function logUpdate($entity, $id, $changes = []) {
        $this->log("UPDATE_{$entity}", array_merge(['id' => $id], $changes), 'INFO');
    }

    public function logDelete($entity, $id) {
        $this->log("DELETE_{$entity}", ['id' => $id], 'WARNING');
    }

    public function logUpload($filename, $size, $type) {
        $this->log('FILE_UPLOAD', [
            'filename' => $filename,
            'size' => $size,
            'type' => $type
        ], 'INFO');
    }

    public function logSecurityEvent($event, $details = []) {
        $this->log("SECURITY_{$event}", $details, 'CRITICAL');
    }

    /**
     * Write to file log
     */
    private function logToFile($logData) {
        if (!is_dir($this->logDir) && !@mkdir($this->logDir, 0755, true)) {
            // Nếu không thể tạo thư mục logs, chuyển sang dùng thư mục tạm của hệ thống
            $this->logDir = sys_get_temp_dir() . '/webgiare_logs';
            if (!is_dir($this->logDir)) {
                @mkdir($this->logDir, 0755, true);
            }
        }

        $date = date('Y-m-d');
        $logFile = $this->logDir . "/admin-{$date}.log";

        $logMessage = json_encode($logData) . PHP_EOL;

        // Bỏ qua cảnh báo nếu không có quyền ghi file
        if (@file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX) === false) {
            error_log("Failed to write to log file: {$logFile}");
        }
    }

    /**
     * Save to database (optional)
     */
    private function logToDatabase($logData) {
        try {
            // Create table if not exists
            $createTable = "
                CREATE TABLE IF NOT EXISTS audit_logs (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    admin_id INT,
                    admin_name VARCHAR(255),
                    action VARCHAR(100),
                    details JSON,
                    ip_address VARCHAR(45),
                    user_agent TEXT,
                    method VARCHAR(10),
                    uri VARCHAR(500),
                    severity ENUM('INFO', 'WARNING', 'CRITICAL'),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    INDEX(admin_id),
                    INDEX(action),
                    INDEX(created_at)
                )
            ";

            $this->dbConnection->exec($createTable);

            // Insert log
            $sql = "INSERT INTO audit_logs 
                    (admin_id, admin_name, action, details, ip_address, user_agent, method, uri, severity) 
                    VALUES (:admin_id, :admin_name, :action, :details, :ip_address, :user_agent, :method, :uri, :severity)";

            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([
                ':admin_id' => $logData['admin_id'],
                ':admin_name' => $logData['admin_name'],
                ':action' => $logData['action'],
                ':details' => $logData['details'],
                ':ip_address' => $logData['ip_address'],
                ':user_agent' => substr($logData['user_agent'], 0, 500),
                ':method' => $logData['method'],
                ':uri' => substr($logData['uri'], 0, 500),
                ':severity' => $logData['severity']
            ]);
        } catch (\Exception $e) {
            // Silent fail - don't interrupt main operation
            error_log("Database logging failed: " . $e->getMessage());
        }
    }

    /**
     * Ensure logs directory exists
     */
    private function ensureLogDirectory() {
        if (!is_dir($this->logDir)) {
            // Cố gắng tạo thư mục, nếu không được thì gán vào /tmp
            if (!@mkdir($this->logDir, 0755, true)) {
                $this->logDir = sys_get_temp_dir() . '/webgiare_logs';
                if (!is_dir($this->logDir)) {
                    @mkdir($this->logDir, 0755, true);
                }
            }
        }
    }

    /**
     * Get recent logs
     */
    public function getRecentLogs($limit = 100) {
        try {
            $sql = "SELECT * FROM audit_logs ORDER BY created_at DESC LIMIT :limit";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get logs by user
     */
    public function getLogsByUser($adminId, $limit = 50) {
        try {
            $sql = "SELECT * FROM audit_logs WHERE admin_id = :admin_id ORDER BY created_at DESC LIMIT :limit";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([
                ':admin_id' => $adminId,
                ':limit' => $limit
            ]);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Get logs by action
     */
    public function getLogsByAction($action, $limit = 50) {
        try {
            $sql = "SELECT * FROM audit_logs WHERE action LIKE :action ORDER BY created_at DESC LIMIT :limit";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([
                ':action' => "%{$action}%",
                ':limit' => $limit
            ]);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Clear old logs (keep last 90 days)
     */
    public function cleanOldLogs($days = 90) {
        try {
            $cutoffDate = date('Y-m-d H:i:s', strtotime("-{$days} days"));
            $sql = "DELETE FROM audit_logs WHERE created_at < :cutoff_date";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->execute([':cutoff_date' => $cutoffDate]);
            
            // Clean file logs older than date
            $files = glob($this->logDir . "/admin-*.log");
            foreach ($files as $file) {
                if (filemtime($file) < strtotime("-{$days} days")) {
                    @unlink($file);
                }
            }
        } catch (\Exception $e) {
            error_log("Failed to clean old logs: " . $e->getMessage());
        }
    }
}
