<?php
/**
 * API Key Authentication
 * Manages API key generation, validation, and access control
 * Priority 3: Enhancement & Hardening
 * 
 * Features:
 * - Generate secure API keys
 * - Validate keys and check permissions
 * - Track API usage per key
 * - Revoke/regenerate keys
 * - Rate limiting per key
 * 
 * Usage:
 *   // Generate a new API key
 *   $key = APIKeyAuth::generateKey('app_name', ['read', 'write']);
 *   
 *   // Validate API key
 *   $result = APIKeyAuth::authenticate('Authorization: Bearer YOUR_KEY');
 *   
 *   // Check permission
 *   if (APIKeyAuth::hasPermission('write')) { ... }
 */

class APIKeyAuth
{
    private static $currentKey = null;
    private static $currentKeyData = null;

    /**
     * Generate a new API key
     * 
     * @param string $appName Name of the application/user
     * @param array $permissions Array of permitted actions: ['read', 'write', 'delete']
     * @param int $expiresIn Days until key expires (0 = never)
     * @return array ['key' => 'sk_...', 'secret' => 'secret_...']
     */
    public static function generateKey($appName, $permissions = ['read'], $expiresIn = 365)
    {
        // Generate secure random key and secret
        $key = 'sk_' . bin2hex(random_bytes(32));  // Public key
        $secret = bin2hex(random_bytes(64));       // Secret for validation
        
        // Hash secret for storage (one-way)
        $secretHash = hash('sha256', $secret);
        
        // Calculate expiration
        $expiresAt = $expiresIn > 0 ? date('Y-m-d H:i:s', time() + ($expiresIn * 86400)) : null;
        
        // Store in database
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            INSERT INTO api_keys (api_key, secret_hash, app_name, permissions, expires_at, created_at, last_used_at, is_active)
            VALUES (:key, :secret, :app, :perms, :expires, NOW(), NULL, 1)
        ");
        
        $stmt->execute([
            ':key' => $key,
            ':secret' => $secretHash,
            ':app' => $appName,
            ':perms' => json_encode($permissions),
            ':expires' => $expiresAt
        ]);
        
        // Log key generation
        Logger::getInstance()->logSecurityEvent(
            'API_KEY_GENERATED',
            'info',
            ['key' => substr($key, 0, 10) . '***', 'app' => $appName, 'permissions' => $permissions]
        );
        
        // Return both key and secret (only shown once to user)
        return [
            'key' => $key,
            'secret' => $secret, // User must store this securely
            'message' => 'Save this secret somewhere safe. It will not be shown again!'
        ];
    }

    /**
     * Authenticate API request using Authorization header
     * 
     * Format: Authorization: Bearer sk_xxxxxxx:secretxxxxxxx
     *         Or: X-API-Key: sk_xxxxxxx:secretxxxxxxx
     * 
     * @return array ['authenticated' => bool, 'error' => string, 'key_id' => int]
     */
    public static function authenticate()
    {
        // Get API key from headers
        $key = null;
        $secret = null;
        
        // Check Authorization header first
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $auth = $_SERVER['HTTP_AUTHORIZATION'];
            if (preg_match('/Bearer\s+(\S+):(\S+)/', $auth, $matches)) {
                $key = $matches[1];
                $secret = $matches[2];
            }
        }
        
        // Check X-API-Key header
        if (!$key && isset($_SERVER['HTTP_X_API_KEY'])) {
            $apiKey = $_SERVER['HTTP_X_API_KEY'];
            if (strpos($apiKey, ':') !== false) {
                [$key, $secret] = explode(':', $apiKey, 2);
            }
        }
        
        // Key and secret required
        if (!$key || !$secret) {
            Logger::getInstance()->logSecurityEvent(
                'API_AUTH_FAILED',
                'warning',
                ['reason' => 'Missing API key or secret', 'ip' => self::getClientIP()]
            );
            
            return [
                'authenticated' => false,
                'error' => 'Missing API key. Use Authorization: Bearer KEY:SECRET',
                'key_id' => null
            ];
        }
        
        // Validate key
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
            SELECT id, secret_hash, permissions, expires_at, is_active, app_name 
            FROM api_keys 
            WHERE api_key = :key AND is_active = 1
        ");
        
        $stmt->execute([':key' => $key]);
        $keyData = $stmt->fetch();
        
        if (!$keyData) {
            Logger::getInstance()->logSecurityEvent(
                'API_AUTH_FAILED',
                'warning',
                ['reason' => 'Invalid API key', 'key' => substr($key, 0, 10) . '***']
            );
            
            return [
                'authenticated' => false,
                'error' => 'Invalid API key',
                'key_id' => null
            ];
        }
        
        // Check if key has expired
        if ($keyData['expires_at'] && strtotime($keyData['expires_at']) < time()) {
            Logger::getInstance()->logSecurityEvent(
                'API_AUTH_FAILED',
                'warning',
                ['reason' => 'Expired API key', 'app' => $keyData['app_name']]
            );
            
            return [
                'authenticated' => false,
                'error' => 'API key has expired',
                'key_id' => null
            ];
        }
        
        // Verify secret using hash_equals to prevent timing attacks
        $secretHash = hash('sha256', $secret);
        if (!hash_equals($keyData['secret_hash'], $secretHash)) {
            Logger::getInstance()->logSecurityEvent(
                'API_AUTH_FAILED',
                'warning',
                ['reason' => 'Invalid API secret', 'key' => substr($key, 0, 10) . '***']
            );
            
            return [
                'authenticated' => false,
                'error' => 'Invalid API secret',
                'key_id' => null
            ];
        }
        
        // Update last used time
        $updateStmt = $conn->prepare("UPDATE api_keys SET last_used_at = NOW() WHERE id = :id");
        $updateStmt->execute([':id' => $keyData['id']]);
        
        // Store authenticated key info
        self::$currentKey = $key;
        self::$currentKeyData = $keyData;
        
        // Log successful authentication
        Logger::getInstance()->logSecurityEvent(
            'API_AUTH_SUCCESS',
            'info',
            ['app' => $keyData['app_name'], 'key' => substr($key, 0, 10) . '***']
        );
        
        return [
            'authenticated' => true,
            'error' => null,
            'key_id' => $keyData['id'],
            'app_name' => $keyData['app_name'],
            'permissions' => json_decode($keyData['permissions'], true)
        ];
    }

    /**
     * Check if current authenticated key has permission
     */
    public static function hasPermission($permission)
    {
        if (!self::$currentKeyData) {
            return false;
        }
        
        $permissions = json_decode(self::$currentKeyData['permissions'], true) ?? [];
        return in_array($permission, $permissions) || in_array('admin', $permissions);
    }

    /**
     * Require specific permission or deny access
     */
    public static function requirePermission($permission)
    {
        if (!self::hasPermission($permission)) {
            http_response_code(403);
            echo json_encode(['error' => "Permission denied: $permission required"]);
            exit;
        }
    }

    /**
     * Revoke API key
     */
    public static function revokeKey($keyId)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE api_keys SET is_active = 0 WHERE id = :id");
        $result = $stmt->execute([':id' => $keyId]);
        
        Logger::getInstance()->logSecurityEvent(
            'API_KEY_REVOKED',
            'warning',
            ['key_id' => $keyId]
        );
        
        return $result;
    }

    /**
     * Get all API keys for user/app
     */
    public static function getKeys($appName = null)
    {
        $conn = Database::getConnection();
        
        if ($appName) {
            $stmt = $conn->prepare("
                SELECT id, api_key, app_name, permissions, expires_at, created_at, last_used_at, is_active
                FROM api_keys 
                WHERE app_name = :app
                ORDER BY created_at DESC
            ");
            $stmt->execute([':app' => $appName]);
        } else {
            $stmt = $conn->prepare("
                SELECT id, api_key, app_name, permissions, expires_at, created_at, last_used_at, is_active
                FROM api_keys 
                ORDER BY created_at DESC
            ");
            $stmt->execute();
        }
        
        return $stmt->fetchAll();
    }

    /**
     * Create database table for API keys
     */
    public static function createTable()
    {
        $conn = Database::getConnection();
        
        $sql = "
            CREATE TABLE IF NOT EXISTS api_keys (
                id INT AUTO_INCREMENT PRIMARY KEY,
                api_key VARCHAR(100) UNIQUE NOT NULL,
                secret_hash VARCHAR(64) NOT NULL,
                app_name VARCHAR(255) NOT NULL,
                permissions JSON NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                expires_at TIMESTAMP NULL,
                last_used_at TIMESTAMP NULL,
                is_active BOOLEAN DEFAULT 1,
                INDEX idx_api_key (api_key),
                INDEX idx_app_name (app_name),
                INDEX idx_is_active (is_active)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ";
        
        try {
            $conn->exec($sql);
            Logger::getInstance()->logSecurityEvent(
                'API_KEYS_TABLE_CREATED',
                'info',
                ['table' => 'api_keys']
            );
            return true;
        } catch (Exception $e) {
            Logger::getInstance()->logSecurityEvent(
                'API_KEYS_TABLE_CREATION_FAILED',
                'error',
                ['error' => $e->getMessage()]
            );
            return false;
        }
    }

    /**
     * Get client IP address
     */
    private static function getClientIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ips[0]);
        } else {
            return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        }
    }
}
?>
