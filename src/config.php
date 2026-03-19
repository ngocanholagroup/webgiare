<?php
// src/config.php - Environment-based configuration

class Config {
    private static $env = null;
    
    public static function get($key, $default = null) {
        // 1. Ưu tiên biến môi trường hệ thống (Docker, Server config)
        $systemEnv = getenv($key);
        if ($systemEnv !== false) {
            return $systemEnv;
        }

        // 2. Nếu không có, đọc từ file .env
        if (self::$env === null) {
            self::loadEnv();
        }
        return self::$env[$key] ?? $default;
    }
    
    public static function isDevelopment() {
        return self::get('APP_ENV') === 'development';
    }
    
    public static function isProduction() {
        return self::get('APP_ENV') === 'production';
    }
    
    public static function isStaging() {
        return self::get('APP_ENV') === 'staging';
    }
    
    public static function getBaseUrl() {
        // Ưu tiên BASE_URL từ env, nếu không có thì auto-detect
        $baseUrl = self::get('BASE_URL');
        if ($baseUrl) {
            return rtrim($baseUrl, '/');
        }
        
        // Auto-detect từ server
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        return $protocol . '://' . $host;
    }
    
    public static function getUploadPath() {
        return self::get('UPLOAD_PATH', 'uploads/');
    }
    
    public static function getMaxUploadSize() {
        return (int) self::get('MAX_UPLOAD_SIZE', 10485760); // 10MB default
    }
    
    public static function getMediaServerUrl() {
        return self::get('MEDIA_SERVER_URL', 'http://localhost:3001/upload');
    }
    
    public static function getDatabaseConfig() {
        return [
            'host' => self::get('DB_HOST', 'localhost'),
            'port' => self::get('DB_PORT', '3306'),
            'database' => self::get('DB_NAME'),
            'username' => self::get('DB_USER'),
            'password' => self::get('DB_PASS'),
            'charset' => 'utf8mb4'
        ];
    }
    
    public static function getJwtSecret() {
        return self::get('JWT_SECRET', 'default-secret-change-in-production');
    }
    
    public static function getEncryptionKey() {
        return self::get('ENCRYPTION_KEY', 'default-32-character-key-here');
    }
    
    public static function isDebugMode() {
        return filter_var(self::get('APP_DEBUG', false), FILTER_VALIDATE_BOOLEAN);
    }
    
    private static function loadEnv() {
        // Ưu tiên dùng environment variable để chỉ định path
        $envFile = getenv('ENV_FILE_PATH') ?: null;
        
        // Nếu không có ENV_FILE_PATH, thử các path khác nhau
        if (!$envFile) {
            $possiblePaths = [
                __DIR__ . '/../.env',                    // Standard structure (Windows/Linux)
                __DIR__ . '/../../.env',                 // Subdirectory structure
                dirname(__DIR__, 2) . '/.env',         // 2 levels up
                dirname(__DIR__, 3) . '/.env',         // 3 levels up
                $_SERVER['DOCUMENT_ROOT'] . '/.env',    // Production server root
                getenv('HOME') . '/.env',                   // Home directory (Linux/Mac)
                getenv('USERPROFILE') . '/.env',          // Home directory (Windows)
                '/var/www/html/.env',                     // Production path (Linux)
                '/var/www/.env',                          // Alternative production (Linux)
                realpath(__DIR__ . '/../../../.env')      // Alternative for different structures
            ];
            
            foreach ($possiblePaths as $path) {
                if ($path && file_exists($path)) {
                    $envFile = $path;
                    break;
                }
            }
        }
        
        if (!$envFile) {
            // Nếu không tìm thấy, tạo thông báo debug chi tiết
            $error = ".env file not found. ";
            $error .= "ENV_FILE_PATH: " . (getenv('ENV_FILE_PATH') ?: 'not set') . "\n";
            $error .= "Tried paths:\n";
            
            $possiblePaths = [
                __DIR__ . '/../.env',
                __DIR__ . '/../../.env',
                dirname(__DIR__, 2) . '/.env',
                dirname(__DIR__, 3) . '/.env',
                $_SERVER['DOCUMENT_ROOT'] . '/.env',
                getenv('HOME') . '/.env',
                '/var/www/html/.env',
                '/var/www/.env'
            ];
            
            foreach ($possiblePaths as $i => $path) {
                $error .= ($i + 1) . ". $path (exists: " . (file_exists($path) ? 'YES' : 'NO') . ")\n";
            }
            
            throw new Exception($error);
        }
        
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        self::$env = [];
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // Bỏ qua comment và dòng trống
            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }
            
            // Parse KEY=VALUE
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                
                // Remove inline comments
                if (strpos($value, '#') !== false) {
                    $value = explode('#', $value, 2)[0];
                }
                
                self::$env[trim($key)] = trim($value);
            }
        }
    }
    
    // Debug function để kiểm tra environment
    public static function debug() {
        if (!self::isDebugMode()) {
            return;
        }
        
        echo "<div style='background: #f0f0f0; padding: 10px; margin: 10px; border: 1px solid #ccc;'>";
        echo "<h3>Environment Debug</h3>";
        echo "<strong>Environment:</strong> " . self::get('APP_ENV') . "<br>";
        echo "<strong>Base URL:</strong> " . self::getBaseUrl() . "<br>";
        echo "<strong>Debug Mode:</strong> " . (self::isDebugMode() ? 'ON' : 'OFF') . "<br>";
        echo "<strong>Database Host:</strong> " . self::get('DB_HOST') . "<br>";
        echo "</div>";
    }
}
?>
