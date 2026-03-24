<?php

class AdminBackupController {
    private $backupDir;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin/login');
            exit;
        }

        // Thư mục chứa backup được mount vào container
        $this->backupDir = '/var/www/backups';
        
        // Tự động tạo thư mục backup nếu chưa tồn tại
        if (!is_dir($this->backupDir)) {
            @mkdir($this->backupDir, 0777, true);
        }
    }

    public function index() {
        $backups = $this->getBackupsList();
        
        $tabs = [
            ['id' => 'tab-list', 'label' => 'Danh sách sao lưu (' . count($backups) . ')', 'icon' => 'database']
        ];

        view('admin.backup', [
            'title' => 'Quản lý Sao lưu & Khôi phục',
            'page_tabs' => $tabs,
            'backups' => $backups
        ]);
    }

    public function createBackup() {
        try {
            // Lấy thời gian hiện tại theo múi giờ Việt Nam để đặt tên file
            $tz = new DateTimeZone('Asia/Ho_Chi_Minh');
            $now = new DateTime('now', $tz);
            // Chuyển sang UTC để lưu tên file đồng nhất với code cũ
            $now->setTimezone(new DateTimeZone('UTC'));
            $timestamp = $now->format("Ymd_His");
            
            // Kiểm tra quyền ghi
            if (!is_writable($this->backupDir)) {
                throw new Exception("Thư mục {$this->backupDir} không có quyền ghi. Vui lòng cấp quyền (VD: chmod 777 docker/backups).");
            }
            
            // Lấy thông tin DB từ môi trường
            $dbHost = getenv('DB_HOST') ?: 'db';
            $dbUser = getenv('DB_USER') ?: 'webgiare_user';
            $dbPass = getenv('DB_PASS') ?: 'root';
            $dbName = getenv('DB_NAME') ?: 'webgiare_dev';
            
            $umamiHost = 'umami_db';
            $umamiUser = getenv('UMAMI_USER') ?: 'admin';
            $umamiPass = getenv('UMAMI_PASSWORD') ?: 'umami';
            $umamiDb = getenv('UMAMI_DB') ?: 'admin';

            // 1. Backup MySQL
            $mysqlFile = "webgiare_db_$timestamp.sql";
            $mysqlPath = $this->backupDir . '/' . $mysqlFile;
            $mysqlCmd = sprintf(
                'mysqldump --skip-ssl --no-tablespaces -h %s -u %s -p%s %s > %s 2>/dev/null',
                escapeshellarg($dbHost),
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbName),
                escapeshellarg($mysqlPath)
            );
            $out1 = shell_exec($mysqlCmd);
            if (!file_exists($mysqlPath) || filesize($mysqlPath) === 0) {
                throw new Exception("Lỗi backup MySQL: " . ($out1 ?: 'Không có phản hồi'));
            }

            // 2. Backup PostgreSQL (Umami)
            $pgFile = "umami_$timestamp.sql";
            $pgPath = $this->backupDir . '/' . $pgFile;
            $pgCmd = sprintf(
                'PGPASSWORD=%s pg_dump --clean --if-exists -O -x -h %s -U %s %s > %s 2>/dev/null',
                escapeshellarg($umamiPass),
                escapeshellarg($umamiHost),
                escapeshellarg($umamiUser),
                escapeshellarg($umamiDb),
                escapeshellarg($pgPath)
            );
            $out2 = shell_exec($pgCmd);
            if (!file_exists($pgPath) || filesize($pgPath) === 0) {
                // Umami DB có thể rỗng hoặc không cần thiết, log lại chứ không throw exception
                error_log("Cảnh báo backup Umami: " . ($out2 ?: 'Không có phản hồi'));
            }

            // 3. Backup uploads local (Files)
            $uploadsFile = "uploads_$timestamp.tar.gz";
            $uploadsPath = $this->backupDir . '/' . $uploadsFile;
            $uploadsDir = "/var/www/html/uploads";
            if (is_dir($uploadsDir)) {
                $tarCmd = sprintf(
                    'cd %s && tar -czf %s uploads 2>&1',
                    escapeshellarg(dirname($uploadsDir)),
                    escapeshellarg($uploadsPath)
                );
                $out3 = shell_exec($tarCmd);
                if (!file_exists($uploadsPath) || filesize($uploadsPath) === 0) {
                    throw new Exception("Lỗi backup uploads: " . ($out3 ?: 'Không có phản hồi'));
                }
            }

            // Cleanup old backups (giữ 7 bản)
            $this->cleanupOldBackups();

            $_SESSION['success'] = "Đã tạo bản sao lưu mới thành công.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Lỗi khi tạo sao lưu: " . $e->getMessage();
        }

        header('Location: /admin/backup');
        exit;
    }

    private function cleanupOldBackups() {
        $files = scandir($this->backupDir);
        $groups = ['webgiare_db' => [], 'umami' => [], 'uploads' => []];
        
        foreach ($files as $file) {
            foreach ($groups as $prefix => &$list) {
                if (strpos($file, $prefix) === 0) {
                    $list[] = $file;
                }
            }
        }

        foreach ($groups as $prefix => $list) {
            rsort($list); // Sắp xếp giảm dần, mới nhất đầu tiên
            if (count($list) > 7) {
                $toDelete = array_slice($list, 7);
                foreach ($toDelete as $delFile) {
                    @unlink($this->backupDir . '/' . $delFile);
                }
            }
        }
    }

    public function restoreBackup() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/backup');
            exit;
        }

        $date = $_POST['date'] ?? '';
        if (empty($date)) {
            $_SESSION['error'] = "Vui lòng chọn bản sao lưu để khôi phục.";
            header('Location: /admin/backup');
            exit;
        }

        // Lấy danh sách file của ngày được chọn
        $mysqlFile = "webgiare_db_$date.sql";
        $uploadsFile = "uploads_$date.tar.gz";
        $pgFile = "umami_$date.sql";

        $mysqlPath = $this->backupDir . '/' . $mysqlFile;
        $uploadsPath = $this->backupDir . '/' . $uploadsFile;
        $pgPath = $this->backupDir . '/' . $pgFile;

        if (!file_exists($mysqlPath)) {
            $_SESSION['error'] = "Không tìm thấy file backup MySQL: $mysqlFile";
            header('Location: /admin/backup');
            exit;
        }

        try {
            // Lấy thông tin DB từ môi trường
            $dbHost = getenv('DB_HOST') ?: 'db';
            $dbUser = getenv('DB_USER') ?: 'webgiare_user';
            $dbPass = getenv('DB_PASS') ?: 'root';
            $dbName = getenv('DB_NAME') ?: 'webgiare_dev';
            
            $umamiHost = 'umami_db';
            $umamiUser = getenv('UMAMI_USER') ?: 'admin';
            $umamiPass = getenv('UMAMI_PASSWORD') ?: 'umami';
            $umamiDb = getenv('UMAMI_DB') ?: 'admin';

            // 1. Khôi phục MySQL
            // Dọn dẹp lỗi mysqldump tablespaces (nếu có) trong các bản backup cũ
            $cleanCmd = sprintf('sed -i \'/^mysqldump: Error:/d\' %s', escapeshellarg($mysqlPath));
            shell_exec($cleanCmd);

            $mysqlCmd = sprintf(
                'mysql --skip-ssl -h %s -u %s -p%s %s < %s 2>&1',
                escapeshellarg($dbHost),
                escapeshellarg($dbUser),
                escapeshellarg($dbPass),
                escapeshellarg($dbName),
                escapeshellarg($mysqlPath)
            );
            $out1 = shell_exec($mysqlCmd);
            if (!empty($out1) && stripos($out1, 'error') !== false) {
                error_log("Lỗi restore MySQL: " . $out1);
                throw new Exception("Lỗi khi khôi phục Database: " . $out1);
            }

            // 2. Khôi phục PostgreSQL (nếu có)
            if (file_exists($pgPath)) {
                $pgCmd = sprintf(
                    'PGPASSWORD=%s psql -h %s -U %s -d %s < %s 2>&1',
                    escapeshellarg($umamiPass),
                    escapeshellarg($umamiHost),
                    escapeshellarg($umamiUser),
                    escapeshellarg($umamiDb),
                    escapeshellarg($pgPath)
                );
                $out2 = shell_exec($pgCmd);
                if (!empty($out2) && stripos($out2, 'error') !== false && stripos($out2, 'does not exist') === false) {
                    error_log("Lỗi restore PostgreSQL: " . $out2);
                }
            }

            // 3. Khôi phục uploads local (nếu có)
            if (file_exists($uploadsPath)) {
                $webDir = "/var/www/html";
                $tarCmd = sprintf(
                    'cd %s && rm -rf uploads && tar -xzf %s 2>&1',
                    escapeshellarg($webDir),
                    escapeshellarg($uploadsPath)
                );
                $out3 = shell_exec($tarCmd);
                if (!empty($out3) && stripos($out3, 'error') !== false) {
                    error_log("Lỗi restore uploads: " . $out3);
                }
            }

            $_SESSION['success'] = "Đã khôi phục dữ liệu thành công từ bản sao lưu ngày $date (PHP Native).";
        } catch (Exception $e) {
            $_SESSION['error'] = "Lỗi khi khôi phục: " . $e->getMessage();
        }

        header('Location: /admin/backup');
        exit;
    }

    private function getBackupsList() {
        if (!is_dir($this->backupDir)) {
            return [];
        }

        $files = scandir($this->backupDir);
        $backups = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            // Parse tên file để lấy ngày giờ
            // Định dạng: webgiare_db_YYYYMMDD_HHMMSS.sql, umami_YYYYMMDD_HHMMSS.sql, uploads_YYYYMMDD_HHMMSS.tar.gz
            if (preg_match('/_(\d{8}_\d{6})\.(sql|tar\.gz)$/', $file, $matches)) {
                $dateStr = $matches[1];
                
                if (!isset($backups[$dateStr])) {
                    $datetime = DateTime::createFromFormat('Ymd_His', $dateStr, new DateTimeZone('UTC'));
                    if ($datetime) {
                        $datetime->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
                    }
                    $backups[$dateStr] = [
                        'id' => $dateStr,
                        'display_date' => $datetime ? $datetime->format('H:i:s - d/m/Y') : $dateStr,
                        'files' => [],
                        'size' => 0
                    ];
                }
                
                $filePath = $this->backupDir . '/' . $file;
                $size = filesize($filePath);
                
                $backups[$dateStr]['files'][] = [
                    'name' => $file,
                    'size' => $size
                ];
                $backups[$dateStr]['size'] += $size;
            }
        }

        // Sắp xếp giảm dần theo ngày (mới nhất lên đầu)
        krsort($backups);
        
        return array_values($backups);
    }
}
