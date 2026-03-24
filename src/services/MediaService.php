<?php

require_once __DIR__ . '/MinioClient.php';

class MediaService {
    /**
     * Upload file trực tiếp lên MinIO
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
            // 2. Lấy nội dung file nguyên bản (Không nén, giữ nguyên bản gốc)
            $fileContent = file_get_contents($file['tmp_name']);
            $mimeType = $file['type'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            // 3. Tạo filename
            $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
            $timestamp = time();
            
            // Xử lý folder
            $folderPath = '';
            if (!empty($folder)) {
                $folderPath = trim($folder, '/') . '/';
            }
            
            $objectName = $folderPath . $originalName . '-' . $timestamp . '.' . $ext;

            // 4. Upload lên MinIO
            $minioClient = self::getMinioClient();
            $bucket = self::getBucketName();
            
            $result = $minioClient->putObject($bucket, $objectName, $fileContent, $mimeType);
            
            if (isset($result['success']) && $result['success'] === true) {
                // Construct public URL
                $publicEndpoint = getenv('MINIO_PUBLIC_ENDPOINT') ?: 'http://localhost:9000';
                $publicEndpoint = rtrim($publicEndpoint, '/');
                $fileUrl = $publicEndpoint . '/' . $bucket . '/' . ltrim($objectName, '/');
                
                return [
                    'success' => true,
                    'url' => $fileUrl
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Lỗi khi upload lên MinIO: ' . ($result['error'] ?? 'Unknown error')
                ];
            }
            
        } catch (Exception $e) {
            error_log("MediaService Upload Error: " . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Lỗi hệ thống: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Xóa file trên MinIO
     * @param string $url URL đầy đủ của ảnh
     * @return array ['success' => bool, 'error' => string]
     */
    public static function delete($url) {
        if (empty($url)) return ['success' => true];

        try {
            // 1. Parse URL để lấy object name
            $path = parse_url($url, PHP_URL_PATH);
            if (!$path) return ['success' => false, 'error' => 'URL không hợp lệ'];

            $path = ltrim($path, '/');
            $parts = explode('/', $path, 2);
            
            if (count($parts) < 2) {
                return ['success' => false, 'error' => 'Format URL không đúng'];
            }
            
            $bucketName = $parts[0]; // Có thể so sánh với getBucketName() nếu cần
            $objectName = $parts[1];

            // 2. Gọi API delete của MinIO
            $minioClient = self::getMinioClient();
            $success = $minioClient->deleteObject($bucketName, $objectName);
            
            if ($success) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => 'Lỗi khi xóa file trên MinIO'];
            }
            
        } catch (Exception $e) {
            error_log("MediaService Delete Error: " . $e->getMessage());
            return ['success' => false, 'error' => 'Lỗi hệ thống: ' . $e->getMessage()];
        }
    }
    
    /**
     * Lấy instance của MinioClient
     */
    private static function getMinioClient() {
        // Lấy thông tin từ biến môi trường
        // Linh hoạt hơn: cho phép endpoint đầy đủ có protocol, hoặc mặc định docker 'minio:9000'
        $endpoint = getenv('MINIO_ENDPOINT') ?: 'minio:9000';
        
        // Nếu endpoint chưa có http/https, thêm http:// vào đầu
        if (!preg_match('/^http(s)?:\/\//', $endpoint)) {
            $endpoint = 'http://' . $endpoint;
        }
        
        // Nếu chưa có port (và không phải port mặc định của http/https), thêm :9000 làm mặc định cho MinIO
        $urlParts = parse_url($endpoint);
        if (!isset($urlParts['port']) && !in_array($urlParts['scheme'], ['http', 'https'])) {
             // Chỉ thêm :9000 nếu không có port
             $endpoint = rtrim($endpoint, '/') . ':9000';
        } else if (!isset($urlParts['port'])) {
            // Nếu parse_url không thấy port nhưng có scheme, có thể cần port nếu là minio mặc định
            // Tuy nhiên, nếu là domain thật (ví dụ s3.amazonaws.com) thì không cần port.
            // Để an toàn, nếu endpoint là 'minio' hoặc 'localhost' mà không có port, thêm :9000
            if (in_array($urlParts['host'], ['minio', 'localhost', '127.0.0.1'])) {
                $endpoint = rtrim($endpoint, '/') . ':9000';
            }
        }

        $accessKey = getenv('MINIO_ROOT_USER') ?: 'admin';
        $secretKey = getenv('MINIO_ROOT_PASSWORD') ?: 'admin123';
        
        return new MinioClient($endpoint, $accessKey, $secretKey);
    }
    
    /**
     * Lấy tên bucket
     */
    private static function getBucketName() {
        return getenv('MINIO_BUCKET_NAME') ?: 'uploads';
    }
}
