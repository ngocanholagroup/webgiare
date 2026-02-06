<?php
class AdminPageController {
    
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        $model = new AdminPage();
        $pages = $model->getAll();
        
        // Tab duy nhất
        $tabs = [['id' => 'tab-list', 'label' => 'Danh sách trang', 'icon' => 'layout']];

        view('admin.page', [
            'title' => 'Quản lý trang tĩnh',
            'page_tabs' => $tabs,
            'pages' => $pages
        ]);
    }

    public function edit($id) {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        $model = new AdminPage();
        $page = $model->getById($id);
        
        if (!$page) die('Trang không tồn tại');

        // Decode JSON để truyền xuống View
        $content = json_decode($page['content_json'], true) ?? [];

        view('admin.page-form', [
            'title' => 'Chỉnh sửa: ' . $page['name'],
            'page' => $page,
            'content' => $content
        ]);
    }

    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;

        // 1. Lấy dữ liệu cơ bản
        $data = [
            'name' => $_POST['name'],
            'meta_title' => $_POST['meta_title'],
            'meta_desc' => $_POST['meta_desc']
        ];

        // 2. Lấy dữ liệu Content JSON
        // Dữ liệu form dynamic được gửi lên dạng mảng $_POST['content']
        $contentData = $_POST['content'] ?? [];
        
        // Mã hóa lại thành JSON (JSON_UNESCAPED_UNICODE để giữ tiếng Việt không bị lỗi font)
        $data['content_json'] = json_encode($contentData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $model = new AdminPage();
        $model->update($id, $data);

        header('Location: /admin/page');
    }
}