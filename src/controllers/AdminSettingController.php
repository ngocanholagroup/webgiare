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
            $data = []; // Chỉ lấy những field cần thiết
            
            // 1. XỬ LÝ CÁC TRƯỜNG TEXT
            foreach ($_POST as $key => $value) {
                // Bỏ qua các field hệ thống
                if (strpos($key, 'old_') === 0) continue;
                if ($key === 'csrf_token') continue;
                
                $data[$key] = $value;
            }

            // 2. XỬ LÝ UPLOAD
            $fileKeys = ['site_logo_url', 'site_favicon_url', 'default_share_image', 'facebook_share_image'];
            $uploadErrors = [];
            
            foreach ($fileKeys as $fieldName) {
                // Lấy giá trị cũ (được form.php gửi lên qua hidden input old_...)
                $oldValue = $_POST['old_' . $fieldName] ?? '';
                $data[$fieldName] = $oldValue;

                // Nếu có file mới được upload
                if (!empty($_FILES[$fieldName]['name'])) {
                    $uploadResult = $this->uploadFile($_FILES[$fieldName], 'setting');
                    
                    if ($uploadResult['success']) {
                        // Xóa ảnh cũ nếu có
                        if (!empty($oldValue)) {
                            MediaService::delete($oldValue);
                        }
                        $data[$fieldName] = $uploadResult['url'];
                    } else {
                        // Ghi lại lỗi nếu upload thất bại
                        $uploadErrors[] = "Lỗi upload {$fieldName}: " . $uploadResult['error'];
                    }
                }
            }

            // 3. LƯU VÀO DATABASE
            foreach ($data as $key => $value) {
                $model->updateSetting($key, $value);
            }
            
            // 4. CHUYỂN HƯỚNG VÀ THÔNG BÁO
            if (!empty($uploadErrors)) {
                $_SESSION['upload_error'] = implode('<br>', $uploadErrors);
                header('Location: /admin/setting?warning=1');
            } else {
                header('Location: /admin/setting?success=1');
            }
        }
    }

    // Helper Upload đơn giản
    private function uploadFile($file, $folder = 'setting') {
        return MediaService::upload($file, $folder);
    }
}