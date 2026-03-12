<?php
require_once __DIR__ . '/../models/AdminSetting.php';
require_once __DIR__ . '/../helpers.php';

class AdminReportController {
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }

        $model = new AdminSetting();
        $settings = $model->getAllSettings();

        // Lấy thống kê từ Google Analytics (API)
        $gaData = [];
        $gaTopPages = [];
        $gaDevices = [];
        $gaChannels = [];
        $gaLocations = [];
        $gaError = null;
        $propertyId = trim($settings['ga4_property_id'] ?? '');
        
        // Fallback: Nếu user nhập nhầm Property ID vào trường Measurement ID
        $measurementId = trim($settings['google_analytics_id'] ?? '');
        if (empty($propertyId) && !empty($measurementId) && is_numeric($measurementId)) {
            $propertyId = $measurementId;
        }

        $credentialsPath = __DIR__ . '/../config/ga4-credentials.json';
        $credentialsExists = file_exists($credentialsPath);

        // DEBUG INFO REMOVED (User confirmed connection)
        
        if (!empty($propertyId)) {
            if (!$credentialsExists) {
                $gaError = 'Đã có Property ID (' . htmlspecialchars($propertyId) . ') nhưng thiếu file cấu hình <strong>src/config/ga4-credentials.json</strong>.';
            } else {
                require_once __DIR__ . '/../models/GoogleAnalyticsService.php';
                $gaService = new GoogleAnalyticsService($propertyId, $credentialsPath);
                
                if ($gaService->isAvailable()) {
                    $report = $gaService->getBasicReport('7daysAgo', 'today');
                    if (isset($report['error'])) {
                        $gaError = $report['error'];
                    } else {
                        $gaData = $report;
                    // Lấy Top Pages
                    $topPages = $gaService->getTopPages('7daysAgo', 'today', 10);
                    if (!isset($topPages['error'])) {
                        $gaTopPages = $topPages;
                    }
                    
                    // Lấy Device Report
                    $devices = $gaService->getDeviceReport('7daysAgo', 'today');
                    if (!isset($devices['error'])) {
                        $gaDevices = $devices;
                    }

                    // Lấy Acquisition Report
                    $channels = $gaService->getAcquisitionReport('7daysAgo', 'today');
                    if (!isset($channels['error'])) {
                        $gaChannels = $channels;
                    }

                    // Lấy Location Report
                    $locations = $gaService->getLocationReport('7daysAgo', 'today', 5);
                    if (!isset($locations['error'])) {
                        $gaLocations = $locations;
                    }
                }
                } else {
                    $gaError = 'Thư viện Google Analytics chưa sẵn sàng (Vui lòng kiểm tra Composer).';
                }
            }
        }

        view('admin.report', [
            'title' => 'Báo cáo truy cập & Thống kê',
            'gaData' => $gaData,
            'gaTopPages' => $gaTopPages,
            'gaDevices' => $gaDevices,
            'gaChannels' => $gaChannels,
            'gaLocations' => $gaLocations,
            'gaError' => $gaError
        ]);
    }
}
