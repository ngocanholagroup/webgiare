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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AdminSetting();
            $data = $_POST; // Dữ liệu text
            $files = $_FILES; // Dữ liệu file

            // 1. DANH SÁCH CÁC TRƯỜNG FILE (Cần khớp với name trong View)
            $fileFields = [
                'site_logo_url' => 'assets/images/',
                'site_favicon_url' => 'assets/images/',
                'default_share_image' => 'assets/images/'
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

            header('Location: /admin/setting?msg=success');
        }
    }

    // Helper Upload đơn giản
    private function uploadFile($file, $targetDir) {
        if ($file['error'] !== UPLOAD_ERR_OK) return false;
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        
        $fileName = time() . '_' . basename($file['name']);
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return '/' . $targetPath;
        }
        return false;
    }
}