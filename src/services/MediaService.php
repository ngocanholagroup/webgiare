<?php

class MediaService {
    /**
     * Upload file lưu local
     * @param array $file $_FILES['input_name']
     * @param string $folder Thư mục lưu trữ trên server (ví dụ: 'blog', 'template')
     * @return array ['success' => bool, 'url' => string, 'error' => string]
     */
    public static function upload($file, $folder = '') {
        // 1. Validate cơ bản
        $validation = FileUploadValidator::validate($file);
        if (!$validation['valid']) {
            return [
                'success' => false, 
                'error' => implode(', ', $validation['errors'])
            ];
        }

        try {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
            $timestamp = time();
            
            $folderPath = '';
            if (!empty($folder)) {
                $folderPath = trim($folder, '/') . '/';
            }
            
            $safeBase = preg_replace('/[^a-zA-Z0-9-_]/', '-', $originalName);
            $filename = $safeBase . '-' . $timestamp . '.' . $ext;
            
            $publicFolder = getenv('UPLOAD_PATH') ?: 'uploads/';
            $publicFolder = rtrim($publicFolder, '/') . '/';
            
            $webRoot = dirname(__DIR__); // src
            $targetDir = $webRoot . DIRECTORY_SEPARATOR . $publicFolder . $folderPath;
            
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0775, true);
            }
            
            $targetPath = $targetDir . $filename;
            if (!@move_uploaded_file($file['tmp_name'], $targetPath)) {
                if (!@copy($file['tmp_name'], $targetPath)) {
                    return ['success' => false, 'error' => 'Không thể lưu file lên máy chủ'];
                }
            }
            
            $urlPath = '/' . trim($publicFolder . $folderPath . $filename, '/');
            return ['success' => true, 'url' => $urlPath];
        } catch (Exception $e) {
            error_log("MediaService Local Upload Error: " . $e->getMessage());
            return ['success' => false, 'error' => 'Lỗi hệ thống: ' . $e->getMessage()];
        }
    }

    /**
     * Xóa file theo driver
     * @param string $url URL đầy đủ của ảnh
     * @return array ['success' => bool, 'error' => string]
     */
    public static function delete($url) {
        if (empty($url)) return ['success' => true];

        $path = parse_url($url, PHP_URL_PATH);
        if (!$path) return ['success' => false, 'error' => 'URL không hợp lệ'];
        $path = ltrim($path, '/');
        $webRoot = dirname(__DIR__); // src
        $fullPath = $webRoot . DIRECTORY_SEPARATOR . $path;
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
        return ['success' => true];
    }
}
