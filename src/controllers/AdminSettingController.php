<?php
class AdminSettingController {
    
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }

        $model = new AdminSetting();
        // Lấy settings dạng ['key' => 'value']
        $settings = $model->getAllSettings();

        // View bây giờ sẽ dùng form.php chung
        view('admin.setting', [
            'title' => 'Cài đặt hệ thống',
            'settings' => $settings
        ]);
    }

    public function save() {
        if (!isset($_SESSION['admin_logged_in'])) exit;

        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AdminSetting();
            $data = $_POST; // Dữ liệu text
            $files = $_FILES; // Dữ liệu file

            // 1. DANH SÁCH CÁC TRƯỜNG FILE (Cần khớp với name trong View)
            $fileFields = [
                'site_logo_url' => 'uploads/images/',
                'site_favicon_url' => 'uploads/images/',
                'default_share_image' => 'uploads/images/',
                'facebook_share_image' => 'uploads/images/'
            ];

            // 2. XỬ LÝ UPLOAD
            foreach ($fileFields as $fieldName => $targetDir) {
                // Lấy đường dẫn cũ (được form.php gửi lên qua hidden input old_...)
                $oldValue = $_POST['old_' . $fieldName] ?? '';
                
                // Mặc định giữ giá trị cũ
                $data[$fieldName] = $oldValue;

                // Nếu có file mới được upload
                if (!empty($files[$fieldName]['name'])) {
                    $newPath = $this->uploadFile($files[$fieldName], $targetDir);
                    if ($newPath) {
                        $data[$fieldName] = $newPath;
                    }
                }
            }

            // 3. LƯU VÀO DATABASE
            // Loại bỏ các field không phải setting (như old_...)
            foreach ($data as $key => $value) {
                if (strpos($key, 'old_') === 0) continue; // Bỏ qua input hidden cũ
                
                // Chỉ update những key có trong DB (để tránh lỗi) hoặc update tất cả tùy logic
                $model->updateSetting($key, $value);
            }
            
            // Log settings update
            // Logger::getInstance()->logUpdate('SETTING', 0, ['settings' => count($data)]);

            header('Location: /admin/setting?msg=success');
        }
    }

    // Helper Upload đơn giản
    private function uploadFile($file, $targetDir) {
        // Debug: Log thông tin file
        error_log("Upload attempt: " . print_r($file, true));
        error_log("Target dir (relative): " . $targetDir);
        
        // Validate file upload
        $validation = FileUploadValidator::validate($file, 'image');
        if (!$validation['valid']) {
            $error_msg = implode(', ', $validation['errors']);
            error_log("Validation failed: " . $error_msg);
            $_SESSION['upload_error'] = $error_msg;
            return false;
        }

        // Fix path resolution: Use absolute path for filesystem operations
        $rootPath = dirname(__DIR__); // Points to src/
        
        // Normalize slashes for Windows
        $normalizedTarget = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($targetDir, '/'));
        $absoluteTargetDir = $rootPath . DIRECTORY_SEPARATOR . $normalizedTarget;

        if (!is_dir($absoluteTargetDir)) {
            if (!mkdir($absoluteTargetDir, 0777, true)) {
                $error = error_get_last();
                $msg = "Failed to create directory: $absoluteTargetDir. Error: " . ($error['message'] ?? 'Unknown');
                error_log($msg);
                $_SESSION['upload_error'] = $msg;
                return false;
            }
            error_log("Created directory: " . $absoluteTargetDir);
        }
        
        // Generate safe filename
        $safeFilename = FileUploadValidator::generateSafeFilename($file['name']);
        if (!$safeFilename) {
            error_log("Invalid file extension: " . $file['name']);
            $_SESSION['upload_error'] = 'Invalid file extension';
            return false;
        }

        $targetPath = $absoluteTargetDir . DIRECTORY_SEPARATOR . $safeFilename;
        error_log("Target path (absolute): " . $targetPath);

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            error_log("Upload successful: " . $targetPath);
            // Return relative path for web access (always forward slashes)
            return '/' . str_replace('\\', '/', $normalizedTarget) . '/' . $safeFilename;
        } else {
            error_log("Upload failed: move_uploaded_file returned false");
            $_SESSION['upload_error'] = 'Failed to move uploaded file';
            return false;
        }
    }
}