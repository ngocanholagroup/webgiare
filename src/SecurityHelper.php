<?php
/**
 * SecurityHelper - Hỗ trợ CSRF Token, Session Security
 */

class SecurityHelper {
    
    /**
     * Tạo CSRF Token
     */
    public static function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Lấy CSRF Token
     */
    public static function getCSRFToken() {
        return $_SESSION['csrf_token'] ?? null;
    }

    /**
     * Xác thực CSRF Token
     * @return bool
     */
    public static function verifyCSRFToken($token = null) {
        if ($token === null) {
            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        }
        
        if (!$token || empty($_SESSION['csrf_token'])) {
            return false;
        }
        
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Kiểm tra Session Timeout
     */
    public static function checkSessionTimeout($timeout = 1800) { // 30 minutes
        if (!isset($_SESSION['last_activity'])) {
            $_SESSION['last_activity'] = time();
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? '';
            return true;
        }

        $elapsed = time() - $_SESSION['last_activity'];
        
        // Timeout
        if ($elapsed > $timeout) {
            session_destroy();
            return false;
        }

        // Validate User-Agent (hỏng session hijacking)
        if (($_SESSION['user_agent'] ?? '') !== ($_SERVER['HTTP_USER_AGENT'] ?? '')) {
            session_destroy();
            return false;
        }

        // Validate IP Address (tùy chọn - có thể gây issue với proxy/mobile)
        // if (($_SESSION['ip_address'] ?? '') !== $_SERVER['REMOTE_ADDR']) {
        //     session_destroy();
        //     return false;
        // }

        // Update last activity
        $_SESSION['last_activity'] = time();
        return true;
    }

    /**
     * Record failed login attempt
     */
    public static function recordFailedLogin($username) {
        $key = 'failed_login_' . md5($username . $_SERVER['REMOTE_ADDR']);
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [
                'count' => 0,
                'first_attempt' => time(),
                'last_attempt' => time()
            ];
        }

        $_SESSION[$key]['count']++;
        $_SESSION[$key]['last_attempt'] = time();

        return $_SESSION[$key];
    }

    /**
     * Check if login is locked due to brute force
     */
    public static function isLoginLocked($username) {
        $key = 'failed_login_' . md5($username . $_SERVER['REMOTE_ADDR']);
        
        if (!isset($_SESSION[$key])) {
            return false;
        }

        $attempt = $_SESSION[$key];
        $lockout_duration = 900; // 15 minutes
        $max_attempts = 5;

        // Reset if timeout exceeded
        if (time() - $attempt['first_attempt'] > $lockout_duration) {
            unset($_SESSION[$key]);
            return false;
        }

        // Check if locked
        if ($attempt['count'] >= $max_attempts) {
            return true;
        }

        return false;
    }

    /**
     * Clear failed login attempts
     */
    public static function clearFailedLogins($username) {
        $key = 'failed_login_' . md5($username . $_SERVER['REMOTE_ADDR']);
        unset($_SESSION[$key]);
    }
}
