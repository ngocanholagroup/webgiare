<?php

class MediaService {
    /**
     * Upload file sang Media Server
     * @param array $file $_FILES['input_name']
     * @param string $folder Thư mục lưu trữ trên server (ví dụ: 'blog', 'template')
     * @return array ['success' => bool, 'url' => string, 'error' => string]
     */
    public static function upload($file, $folder = '') {
        // URL của media server (satellite)
        $apiUrl = Config::getMediaServerUrl();

        // 1. Validate cơ bản (nếu chưa validate ở controller)
        // Lưu ý: FileUploadValidator kiểm tra file upload PHP, vẫn cần thiết để đảm bảo an toàn trước khi gửi đi
        $validation = FileUploadValidator::validate($file);
        if (!$validation['valid']) {
            return [
                'success' => false, 
                'error' => implode(', ', $validation['errors'])
            ];
        }

        // 2. Chuẩn bị gửi sang Media Server
        // Sử dụng CURLFile để gửi file
        if (!function_exists('curl_init')) {
            return [
                'success' => false,
                'error' => 'Server không hỗ trợ cURL'
            ];
        }

        $cfile = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
        $data = [
            'image' => $cfile,
            'folder' => $folder // Thêm tham số folder
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout 30s

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // 3. Xử lý lỗi kết nối
        if ($error) {
            error_log("MediaService Error: " . $error);
            return [
                'success' => false,
                'error' => 'Lỗi kết nối đến Media Server: ' . $error
            ];
        }

        if ($httpCode !== 200) {
            error_log("MediaService HTTP Error: " . $httpCode . " Response: " . $response);
            return [
                'success' => false,
                'error' => 'Media Server trả về lỗi ' . $httpCode
            ];
        }

        // 4. Xử lý kết quả
        $result = json_decode($response, true);
        
        if ($result && isset($result['success']) && $result['success'] && isset($result['url'])) {
            return [
                'success' => true,
                'url' => $result['url']
            ];
        }

        $serverError = $result['error'] ?? 'Phản hồi không hợp lệ';
        return [
            'success' => false,
            'error' => 'Lỗi từ Media Server: ' . $serverError
        ];
    }

    /**
     * Xóa file trên Media Server
     * @param string $url URL đầy đủ của ảnh (ví dụ: http://localhost:9000/uploads/blog/abc.webp)
     * @return array ['success' => bool, 'error' => string]
     */
    public static function delete($url) {
        if (empty($url)) return ['success' => true]; // Không có ảnh thì coi như xóa thành công

        // 1. Parse URL để lấy filename (object key)
        // URL: http://host:port/bucket/folder/file.ext
        $path = parse_url($url, PHP_URL_PATH); // /bucket/folder/file.ext
        if (!$path) return ['success' => false, 'error' => 'URL không hợp lệ'];

        $path = ltrim($path, '/'); // bucket/folder/file.ext
        $parts = explode('/', $path, 2);
        
        // Cần ít nhất bucket/filename
        if (count($parts) < 2) {
            return ['success' => false, 'error' => 'Format URL không đúng (thiếu bucket hoặc filename)'];
        }
        
        $filename = $parts[1]; // folder/file.ext

        // 2. Gọi API delete
        $uploadUrl = Config::getMediaServerUrl();
        // Thay thế /upload bằng /delete ở cuối
        $deleteUrl = preg_replace('/\/upload$/', '/delete', $uploadUrl);
        
        // Nếu URL không kết thúc bằng /upload (ví dụ chỉ có host), nối thêm /delete
        if ($deleteUrl === $uploadUrl) {
             $deleteUrl = rtrim($uploadUrl, '/') . '/delete';
        }

        $data = json_encode(['filename' => $filename]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $deleteUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            error_log("MediaService Delete Error: " . $error);
            return ['success' => false, 'error' => $error];
        }

        if ($httpCode !== 200) {
            error_log("MediaService Delete HTTP Error: " . $httpCode);
            return ['success' => false, 'error' => 'HTTP ' . $httpCode];
        }

        return ['success' => true];
    }
}
