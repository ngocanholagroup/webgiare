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
    }

    public function index() {
        $backups = $this->getBackupsList();
        require __DIR__ . '/../views/admin/backup.php';
    }

    public function createBackup() {
        try {
            // Chạy lệnh backup thông qua docker exec vào container webgiare_backup
            $cmd = 'sudo /usr/bin/docker exec webgiare_backup bash /workspace/backup-db.sh 2>&1';
            $output = shell_exec($cmd);
            
            $_SESSION['success'] = "Đã tạo bản sao lưu mới thành công.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Lỗi khi tạo sao lưu: " . $e->getMessage();
        }

        header('Location: /admin/backup');
        exit;
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
        $minioFile = "minio_data_$date.tar.gz";
        $pgFile = "umami_$date.sql";

        // Kiểm tra xem các file có tồn tại không
        if (!file_exists($this->backupDir . '/' . $mysqlFile)) {
            $_SESSION['error'] = "Không tìm thấy file backup MySQL: $mysqlFile";
            header('Location: /admin/backup');
            exit;
        }

        try {
            // Chạy lệnh khôi phục thông qua docker exec
            // Gửi 'yes' vào stdin để vượt qua phần xác nhận của script restore-db.sh
            $cmd = sprintf(
                'cd /var/www/html && echo "yes" | sudo bash /var/www/docker/restore-db.sh all %s %s %s 2>&1',
                escapeshellarg($mysqlFile),
                escapeshellarg($minioFile),
                escapeshellarg($pgFile)
            );
            
            $output = shell_exec($cmd);

            $_SESSION['success'] = "Đã khôi phục dữ liệu thành công từ bản sao lưu ngày $date.";
            
            // Có thể lưu output vào session để debug nếu cần
            // $_SESSION['restore_log'] = $output;
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
            // Định dạng: webgiare_db_YYYYMMDD_HHMMSS.sql
            if (preg_match('/_(\d{8}_\d{6})\./', $file, $matches)) {
                $dateStr = $matches[1];
                
                if (!isset($backups[$dateStr])) {
                    $datetime = DateTime::createFromFormat('Ymd_His', $dateStr);
                    $backups[$dateStr] = [
                        'id' => $dateStr,
                        'display_date' => $datetime ? $datetime->format('d/m/Y H:i:s') : $dateStr,
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
