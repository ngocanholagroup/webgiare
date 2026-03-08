<?php
/**
 * Rate Limiter Middleware
 * Prevents abuse by limiting requests per IP address
 * Priority 3: Enhancement & Hardening
 * 
 * Supports multiple strategies:
 * - Per-IP rate limiting
 * - Per-endpoint rate limiting
 * - Sliding window / Token bucket algorithms
 * 
 * Usage:
 *   RateLimiter::checkLimit('general'); // 100 requests per minute
 *   RateLimiter::checkLimit('login', 5, 60); // 5 requests per 60 seconds
 */

class RateLimiter
{
    // Use system temp directory for rate limit storage (writable in Docker)
    private static $storageDir = null;
    
    public static function getStorageDir()
    {
        if (self::$storageDir === null) {
            self::$storageDir = sys_get_temp_dir() . '/webgiare_rate_limit';
        }
        return self::$storageDir;
    }
    
    // Default limits (requests, time window in seconds)
    private static $defaultLimits = [
        'general' => [100, 60],      // 100 requests per minute
        'login' => [5, 300],          // 5 requests per 5 minutes
        'api' => [500, 3600],         // 500 requests per hour
        'upload' => [10, 300],        // 10 requests per 5 minutes
        'contact' => [3, 3600]        // 3 requests per hour
    ];

    /**
     * Initialize rate limiter (create storage directory if needed)
     */
    public static function init()
    {
        $dir = self::getStorageDir();
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    /**
     * Check if request should be allowed based on rate limit
     * 
     * @param string $endpoint Endpoint name (e.g., 'login', 'api', 'contact')
     * @param int $maxRequests Max requests allowed
     * @param int $timeWindow Time window in seconds
     * @return array ['allowed' => bool, 'remaining' => int, 'resetTime' => int]
     */
    public static function checkLimit($endpoint = 'general', $maxRequests = null, $timeWindow = null)
    {
        // Initialize if first time
        self::init();
        
        // Use default limits if not specified
        if ($maxRequests === null || $timeWindow === null) {
            if (isset(self::$defaultLimits[$endpoint])) {
                [$maxRequests, $timeWindow] = self::$defaultLimits[$endpoint];
            } else {
                [$maxRequests, $timeWindow] = [100, 60];
            }
        }
        
        $storageDir = self::getStorageDir();
        $clientIP = self::getClientIP();
        $key = hash('sha256', $endpoint . ':' . $clientIP);
        $file = $storageDir . '/' . $key . '.json';
        
        $now = time();
        $data = self::readData($file);
        
        // Clean old entries (older than time window)
        $data['requests'] = array_filter($data['requests'], function($timestamp) use ($now, $timeWindow) {
            return ($now - $timestamp) < $timeWindow;
        });
        
        // Count current requests in window
        $requestCount = count($data['requests']);
        $allowed = $requestCount < $maxRequests;
        
        // Record this request if from API or need tracking
        if ($allowed) {
            $data['requests'][] = $now;
            self::writeData($file, $data);
        }
        
        // Calculate reset time
        $oldestRequest = reset($data['requests']);
        $resetTime = $oldestRequest ? $oldestRequest + $timeWindow : $now + $timeWindow;
        
        // Log rate limit violations
        if (!$allowed) {
            Logger::getInstance()->logSecurityEvent(
                'RATE_LIMIT_EXCEEDED',
                'warning',
                ['endpoint' => $endpoint, 'ip' => $clientIP, 'requests' => $requestCount, 'max' => $maxRequests]
            );
        }
        
        return [
            'allowed' => $allowed,
            'remaining' => max(0, $maxRequests - $requestCount),
            'resetTime' => $resetTime,
            'limit' => $maxRequests,
            'window' => $timeWindow
        ];
    }

    /**
     * Enforce rate limit - sends 429 if exceeded
     */
    public static function enforce($endpoint = 'general', $maxRequests = null, $timeWindow = null)
    {
        $result = self::checkLimit($endpoint, $maxRequests, $timeWindow);
        
        if (!$result['allowed']) {
            http_response_code(429); // Too Many Requests
            header('Retry-After: ' . $result['resetTime']);
            header('X-RateLimit-Limit: ' . $result['limit']);
            header('X-RateLimit-Remaining: 0');
            header('X-RateLimit-Reset: ' . $result['resetTime']);
            
            die(json_encode([
                'error' => 'Too many requests',
                'retry_after' => $result['resetTime'],
                'message' => 'You have exceeded the rate limit. Please try again later.'
            ]));
        }
        
        return $result;
    }

    /**
     * Get current IP address (accounting for proxies)
     */
    private static function getClientIP()
    {
        // Check for IP from shared internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        // Check for IP passed from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Handle multiple IPs (take the first one)
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim($ips[0]);
        }
        // Check for remote address
        else {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        }
        
        // Validate IP
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
        
        return '0.0.0.0';
    }

    /**
     * Read rate limit data from file
     */
    private static function readData($file)
    {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $data = json_decode($content, true);
            return is_array($data) ? $data : ['requests' => []];
        }
        return ['requests' => []];
    }

    /**
     * Write rate limit data to file
     */
    private static function writeData($file, $data)
    {
        file_put_contents($file, json_encode($data), LOCK_EX);
    }

    /**
     * Reset rate limit for specific endpoint and IP
     */
    public static function reset($endpoint, $clientIP = null)
    {
        self::init();
        $storageDir = self::getStorageDir();
        
        if ($clientIP === null) {
            $clientIP = self::getClientIP();
        }
        
        $key = hash('sha256', $endpoint . ':' . $clientIP);
        $file = $storageDir . '/' . $key . '.json';
        
        if (file_exists($file)) {
            unlink($file);
            return true;
        }
        
        return false;
    }

    /**
     * Clean up old rate limit data
     * Call periodically via cron job
     */
    public static function cleanup($maxAge = 86400)
    {
        self::init();
        $storageDir = self::getStorageDir();
        
        $now = time();
        $deleted = 0;
        
        foreach (glob($storageDir . '/*.json') as $file) {
            if ($now - filemtime($file) > $maxAge) {
                unlink($file);
                $deleted++;
            }
        }
        
        return $deleted;
    }

    /**
     * Get stats for all rate-limited endpoints
     */
    public static function getStats()
    {
        self::init();
        $storageDir = self::getStorageDir();
        
        $stats = [];
        foreach (glob($storageDir . '/*.json') as $file) {
            $data = self::readData($file);
            $stats[basename($file)] = [
                'requests' => count($data['requests']),
                'lastUpdate' => date('Y-m-d H:i:s', filemtime($file))
            ];
        }
        
        return $stats;
    }

    /**
     * Add custom limit configuration
     */
    public static function setLimit($endpoint, $maxRequests, $timeWindow)
    {
        self::$defaultLimits[$endpoint] = [$maxRequests, $timeWindow];
    }

    /**
     * Get all configured limits
     */
    public static function getLimits()
    {
        return self::$defaultLimits;
    }
}

// Auto-initialize on class load
RateLimiter::init();
?>
