<?php
require_once __DIR__ . '/../models/AdminSetting.php';
require_once __DIR__ . '/../helpers.php';

class AdminReportController {
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }

        $model = new AdminSetting();
        $settings = $model->getAllSettings();
        $embedUrl = $settings['analytics_embed_url'] ?? '';

        view('admin.report', [
            'title' => 'Báo cáo truy cập & Thống kê',
            'embedUrl' => $embedUrl
        ]);
    }

    public function saveConfig() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $embedUrl = $_POST['analytics_embed_url'] ?? '';
            
            // Validate URL (basic check)
            if (!empty($embedUrl) && !filter_var($embedUrl, FILTER_VALIDATE_URL)) {
                // Handle invalid URL error if needed
            }

            $model = new AdminSetting();
            $model->updateSetting('analytics_embed_url', $embedUrl);

            header('Location: /admin/report?msg=success');
        }
    }
}
