<?php
// Chỉ cho phép chạy qua CLI (cron, terminal)
if (php_sapi_name() !== 'cli') {
    die("Script only allowed via CLI.");
}

require_once __DIR__ . '/config.php';
// Load env nếu chưa tự động
Config::get('APP_ENV');

// Thư mục lưu backup
$backupDir = '/var/www/backups';
if (!is_dir($backupDir)) {
    @mkdir($backupDir, 0777, true);
}

try {
    echo "[" . date('Y-m-d H:i:s') . "] Chạy tiến trình Auto Backup...\n";
    // Lấy thời gian format theo UTC để thống nhất với web
    $tz = new DateTimeZone('Asia/Ho_Chi_Minh');
    $now = new DateTime('now', $tz);
    $now->setTimezone(new DateTimeZone('UTC'));
    $timestamp = $now->format("Ymd_His");

    $dbHost = Config::get('DB_HOST') ?: 'db';
    $dbUser = Config::get('DB_USER') ?: 'webgiare_user';
    $dbPass = Config::get('DB_PASS') ?: 'root';
    $dbName = Config::get('DB_NAME') ?: 'webgiare_dev';
    
    $umamiHost = 'umami_db';
    $umamiUser = Config::get('UMAMI_USER') ?: 'admin';
    $umamiPass = Config::get('UMAMI_PASSWORD') ?: 'umami';
    $umamiDb = Config::get('UMAMI_DB') ?: 'admin';

    // 1. Backup MySQL
    echo "1. Backup MySQL ($dbName)\n";
    $mysqlFile = "webgiare_db_$timestamp.sql";
    $mysqlPath = $backupDir . '/' . $mysqlFile;
    $mysqlCmd = sprintf(
        'mysqldump --skip-ssl --no-tablespaces -h %s -u %s -p%s %s > %s 2>/dev/null',
        escapeshellarg($dbHost),
        escapeshellarg($dbUser),
        escapeshellarg($dbPass),
        escapeshellarg($dbName),
        escapeshellarg($mysqlPath)
    );
    shell_exec($mysqlCmd);

    // 2. Backup PostgreSQL (Umami)
    echo "2. Backup PostgreSQL Umami ($umamiDb)\n";
    $pgFile = "umami_$timestamp.sql";
    $pgPath = $backupDir . '/' . $pgFile;
    $pgCmd = sprintf(
        'PGPASSWORD=%s pg_dump --clean --if-exists -O -x -h %s -U %s %s > %s 2>/dev/null',
        escapeshellarg($umamiPass),
        escapeshellarg($umamiHost),
        escapeshellarg($umamiUser),
        escapeshellarg($umamiDb),
        escapeshellarg($pgPath)
    );
    shell_exec($pgCmd);

    // 3. Backup uploads local (Files)
    echo "3. Backup thư mục Uploads\n";
    $uploadsFile = "uploads_$timestamp.tar.gz";
    $uploadsPath = $backupDir . '/' . $uploadsFile;
    $uploadsDir = "/var/www/html/uploads";
    if (is_dir($uploadsDir)) {
        $tarCmd = sprintf(
            'cd %s && tar -czf %s uploads 2>&1',
            escapeshellarg(dirname($uploadsDir)),
            escapeshellarg($uploadsPath)
        );
        shell_exec($tarCmd);
    }

    // 4. Cleanup old backups (giữ 7 bản mới nhất)
    echo "4. Dọn dẹp bản backup cũ\n";
    $files = scandir($backupDir);
    $groups = ['webgiare_db' => [], 'umami' => [], 'uploads' => []];
    
    foreach ($files as $file) {
        foreach ($groups as $prefix => &$list) {
            if (strpos($file, $prefix) === 0) {
                $list[] = $file;
            }
        }
    }

    foreach ($groups as $prefix => $list) {
        rsort($list);
        if (count($list) > 7) {
            $toDelete = array_slice($list, 7);
            foreach ($toDelete as $delFile) {
                @unlink($backupDir . '/' . $delFile);
                echo "   - Đã xóa file cũ: $delFile\n";
            }
        }
    }

    echo "[" . date('Y-m-d H:i:s') . "] Hoàn thành tiến trình Backup.\n";

} catch (Exception $e) {
    echo "[" . date('Y-m-d H:i:s') . "] LỖI GẶP PHẢI: " . $e->getMessage() . "\n";
}
