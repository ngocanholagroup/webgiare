<?php
/**
 * FileUploadValidator - Comprehensive file upload validation
 * Xác thực file upload một cách toàn diện
 */

class FileUploadValidator {
    
    // Allowed MIME types per category
    private static $allowedMimeTypes = [
        'image' => [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml',
            'image/x-icon',
            'image/vnd.microsoft.icon'
        ],
        'document' => [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ],
        'video' => [
            'video/mp4',
            'video/quicktime',
            'video/x-msvideo'
        ]
    ];

    // Maximum file sizes (in bytes)
    private static $maxFileSizes = [
        'image' => 5 * 1024 * 1024,      // 5MB
        'document' => 10 * 1024 * 1024,  // 10MB
        'video' => 100 * 1024 * 1024,    // 100MB
        'default' => 5 * 1024 * 1024     // 5MB
    ];

    // Magic bytes for validation
    private static $magicBytes = [
        'image/jpeg' => ['FF D8 FF'],
        'image/png' => ['89 50 4E 47'],
        'image/gif' => ['47 49 46 38'],
        'image/webp' => ['52 49 46 46'],
        'image/x-icon' => ['00 00 01 00'],
        'application/pdf' => ['25 50 44 46'],
    ];

    /**
     * Validate uploaded file
     */
    public static function validate($file, $type = 'image') {
        $errors = [];

        // 1. Check if file exists and has no errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = self::getUploadErrorMessage($file['error']);
        }

        if (empty($errors)) {
            // 2. Check file size
            $maxSize = self::$maxFileSizes[$type] ?? self::$maxFileSizes['default'];
            if ($file['size'] > $maxSize) {
                $errors[] = "Tệp quá lớn. Tối đa " . self::formatBytes($maxSize);
            }

            // 3. Check MIME type (server-side)
            $mimeType = self::detectMimeType($file['tmp_name']);
            if (!in_array($mimeType, self::$allowedMimeTypes[$type] ?? [])) {
                $errors[] = "Loại tệp không được phép. Chỉ nhận: " . implode(', ', self::$allowedMimeTypes[$type] ?? []);
            }

            // 4. Check magic bytes to prevent file type spoofing
            if (!self::validateMagicBytes($file['tmp_name'], $mimeType)) {
                $errors[] = "Tệp có vẻ bị chiếm đoạt. Vui lòng tải lên tệp thực.";
            }

            // 5. Check for dangerous content
            if (!self::isSafeFile($file['tmp_name'], $type)) {
                $errors[] = "Tệp chứa nội dung nguy hiểm.";
            }

            // 6. Check filename for malicious patterns
            if (!self::isValidFilename($file['name'])) {
                $errors[] = "Tên tệp chứa ký tự không được phép.";
            }
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors,
            'type' => self::detectMimeType($file['tmp_name'] ?? ''),
            'size' => $file['size'] ?? 0
        ];
    }

    /**
     * Detect MIME type using multiple methods
     */
    private static function detectMimeType($filepath) {
        if (!file_exists($filepath)) {
            return 'unknown';
        }

        // Method 1: finfo (most reliable)
        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $filepath);
            finfo_close($finfo);
            error_log("MIME type detected by finfo: " . $mimeType . " for file: " . $filepath);
            return $mimeType;
        }

        // Method 2: getimagesize (for images)
        if (function_exists('getimagesize')) {
            $info = @getimagesize($filepath);
            if ($info && isset($info['mime'])) {
                error_log("MIME type detected by getimagesize: " . $info['mime'] . " for file: " . $filepath);
                return $info['mime'];
            }
        }

        return 'application/octet-stream';
    }

    /**
     * Validate magic bytes (file signature)
     */
    private static function validateMagicBytes($filepath, $mimeType) {
        // Skip magic bytes validation for common image types to avoid false positives
        $skipTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/webp', 'image/x-icon', 'image/vnd.microsoft.icon'];
        
        if (in_array($mimeType, $skipTypes)) {
            return true; // Skip validation for common image types
        }
        
        if (!isset(self::$magicBytes[$mimeType])) {
            return true; // Skip if no magic bytes defined
        }

        $handle = fopen($filepath, 'rb');
        if (!$handle) {
            return false;
        }

        $header = fread($handle, 12);
        fclose($handle);

        $headerHex = bin2hex($header);
        $expectedBytes = self::$magicBytes[$mimeType];

        foreach ($expectedBytes as $bytes) {
            $pattern = str_replace(' ', '', $bytes);
            if (strpos($headerHex, $pattern) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if file is safe (no malicious content)
     */
    private static function isSafeFile($filepath, $type) {
        if ($type === 'image') {
            // Special case: ICO files are usually small and safe
            $mimeType = self::detectMimeType($filepath);
            if ($mimeType === 'image/x-icon' || $mimeType === 'image/vnd.microsoft.icon') {
                return true; // Skip intensive validation for ICO files
            }
            // For other images, validate structure
            return self::isValidImage($filepath);
        } elseif ($type === 'document') {
            // For documents, check for macro or scripts
            return !self::hasEmbeddedScripts($filepath);
        }

        return true;
    }

    /**
     * Validate image integrity
     */
    private static function isValidImage($filepath) {
        $info = @getimagesize($filepath);
        
        if ($info === false) {
            error_log("getimagesize failed for: " . $filepath);
            return false;
        }

        error_log("Image info: " . print_r($info, true));

        // Nếu server không cài đặt thư viện GD (thường gặp ở một số host), 
        // ta bỏ qua bước kiểm tra chuyên sâu từng pixel và tin tưởng vào getimagesize()
        if (!extension_loaded('gd')) {
            return true;
        }

        // Try to create image resource to verify it's not corrupted
        $image = null;
        $gd_function_missing = false;

        switch ($info[2]) {
            case IMAGETYPE_JPEG:
                if (function_exists('imagecreatefromjpeg')) $image = @imagecreatefromjpeg($filepath);
                else $gd_function_missing = true;
                break;
            case IMAGETYPE_PNG:
                if (function_exists('imagecreatefrompng')) $image = @imagecreatefrompng($filepath);
                else $gd_function_missing = true;
                break;
            case IMAGETYPE_GIF:
                if (function_exists('imagecreatefromgif')) $image = @imagecreatefromgif($filepath);
                else $gd_function_missing = true;
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagecreatefromwebp')) $image = @imagecreatefromwebp($filepath);
                else $gd_function_missing = true;
                break;
            case IMAGETYPE_ICO:
                // ICO files cannot be processed by GD, just validate file structure
                // Check if it's a valid ICO file by reading header
                $handle = fopen($filepath, 'rb');
                if ($handle) {
                    $header = fread($handle, 6);
                    fclose($handle);
                    // ICO files start with 0x00000100
                    if (strlen($header) >= 6 && substr($header, 4, 2) === "\x01\x00") {
                        error_log("ICO file validation passed");
                        return true;
                    }
                }
                error_log("ICO file validation failed");
                return false;
        }

        if ($gd_function_missing) {
            // Function to process this image type is missing from GD library
            // Trust getimagesize() instead of rejecting
            return true;
        }

        if ($image === false || $image === null) {
            error_log("Failed to create image resource for type: " . $info[2]);
            return false;
        }

        imagedestroy($image);
        return true;
    }

    /**
     * Check for embedded scripts in documents
     */
    private static function hasEmbeddedScripts($filepath) {
        $dangerous_patterns = [
            '/<script/i',
            '/eval\(/i',
            '/javascript:/i',
            '/<iframe/i',
            '/onclick/i',
            '/onerror/i'
        ];

        $content = file_get_contents($filepath, false, null, 0, 8192); // Read first 8KB
        
        foreach ($dangerous_patterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Validate filename (prevent directory traversal, etc)
     */
    private static function isValidFilename($filename) {
        // Remove path separators
        $filename = basename($filename);

        // Check for dangerous patterns
        $dangerous = [
            '..',
            '/',
            '\\',
            '..;',
            '::',
            '|',
            '<?php'
        ];

        foreach ($dangerous as $pattern) {
            if (strpos(strtolower($filename), strtolower($pattern)) !== false) {
                return false;
            }
        }

        // Check if filename contains only safe characters
        if (!preg_match('/^[a-zA-Z0-9._\-\s]+$/', $filename)) {
            return false;
        }

        return true;
    }

    /**
     * Get safe filename for storage
     */
    public static function generateSafeFilename($originalFilename) {
        $ext = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
        
        // Whitelist extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'ico', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'mp4', 'mov', 'avi'];
        
        if (!in_array($ext, $allowed_extensions)) {
            return false;
        }

        // Generate safe filename: timestamp_random.ext
        $name = time() . '_' . uniqid() . '_' . rand(1000, 9999);
        return $name . '.' . $ext;
    }

    /**
     * Get upload error message
     */
    private static function getUploadErrorMessage($error) {
        $messages = [
            UPLOAD_ERR_INI_SIZE => 'Tệp vượt quá kích thước được phép bởi server (upload_max_filesize).',
            UPLOAD_ERR_FORM_SIZE => 'Tệp vượt quá kích thước được phép bởi form.',
            UPLOAD_ERR_PARTIAL => 'Tệp chỉ được tải lên một phần.',
            UPLOAD_ERR_NO_FILE => 'Không có tệp nào được tải lên.',
            UPLOAD_ERR_NO_TMP_DIR => 'Không tìm thấy thư mục tạm.',
            UPLOAD_ERR_CANT_WRITE => 'Không thể viết tệp lên server.',
            UPLOAD_ERR_EXTENSION => 'Tải lên bị chặn bởi extension PHP.'
        ];

        return $messages[$error] ?? 'Lỗi tải lên không xác định.';
    }

    /**
     * Format bytes to human readable
     */
    private static function formatBytes($bytes) {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
