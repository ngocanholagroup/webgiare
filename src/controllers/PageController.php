<?php
// src/controllers/PageController.php
require_once __DIR__ . '/../models/Page.php';

class PageController {
    private $pageModel;

    public function __construct() {
        $this->pageModel = new PageModel();
    }

    // Xử lý trang chủ (Route: /)
    public function home() {
        // Slug trong DB là 'home', View file là 'client/home.php'
        $this->renderPage('home', 'client.home');
    }

    // Xử lý trang giới thiệu (Route: /gioi-thieu)
    public function about() {
        $this->renderPage('about', 'client.about');
    }

    // Xử lý trang chính sách / điều khoản (Route: /chinh-sach)
    public function policy() {
        $this->renderPage('policy', 'client.policy');
    }

    // Xử lý trang dịch vụ (Route: /dich-vu)
    public function services() {
        $this->renderPage('services', 'client.services');
    }

    // --- Hàm xử lý chung (Private) ---
    private function renderPage($dbSlug, $viewPath) {
        // 1. Lấy dữ liệu từ Model
        $page = $this->pageModel->getPage($dbSlug);

        // 2. Nếu không tìm thấy trong DB -> Báo lỗi 404
        if (!$page) {
            // Có thể redirect về trang 404 hoặc echo lỗi
            echo "Lỗi: Không tìm thấy trang '{$dbSlug}' trong database.";
            return;
        }

        // 3. Chuẩn bị dữ liệu để đẩy sang View
        // Biến $c sẽ chứa mảng nội dung decoded từ JSON
        $data = [
            'c' => $page['content'], 
            
            // Meta SEO (Header sẽ tự nhận các biến này)
            'meta_title' => $page['meta_title'] ?? $page['name'],
            'meta_desc'  => $page['meta_desc'],
            'meta_image' => $page['meta_image'],
            
            // Thông tin cơ bản khác nếu cần
            'page_title' => $page['name'],
            'updated_at' => $page['updated_at']
        ];

        // 4. Gọi View
        view($viewPath, $data);
    }
}