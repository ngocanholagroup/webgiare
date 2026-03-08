<?php
// src/controllers/AdminTemplateCategoryController.php

class AdminTemplateCategoryController {
    
    // 1. Form Tạo mới
    public function create() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        // Load view form (dùng chung cho create/edit)
        view('admin.template-category-form', [
            'title' => 'Thêm Danh mục Giao diện'
        ]);
    }

    // 2. Xử lý Lưu (Store)
    public function store() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }
        
        $data = $_POST;
        
        // Validate cơ bản
        if (empty($data['name'])) {
            // Có thể thêm flash message lỗi ở đây
            header('Location: /admin/category/create'); 
            exit;
        }

        // Auto Slug
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['name']);
        }

        $model = new AdminTemplateCategory();
        $newId = $model->create($data);
        
        // Log create action
        Logger::getInstance()->logCreate('TEMPLATE_CATEGORY', $newId, ['name' => $data['name']]);

        // Chuyển hướng sang trang sửa danh mục vừa tạo
        header('Location: /admin/category/edit/' . $newId);
    }

    // 3. Form Sửa (Edit)
    public function edit($id) {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        $model = new AdminTemplateCategory();
        $category = $model->getById($id);

        if (!$category) { echo "Danh mục không tồn tại"; return; }

        view('admin.template-category-form', [
            'title' => 'Cập nhật Danh mục',
            'category' => $category // Truyền dữ liệu cũ sang view
        ]);
    }

    // 4. Xử lý Cập nhật (Update)
    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }
        
        $data = $_POST;
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['name']);
        }

        $model = new AdminTemplateCategory();
        $model->update($id, $data);
        
        // Log update action
        Logger::getInstance()->logUpdate('TEMPLATE_CATEGORY', $id, ['name' => $data['name']]);

        header('Location: /admin/category/edit/' . $id);
    }

    // 5. Xóa
    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $model = new AdminTemplateCategory();
        $category = $model->getById($id);
        
        $model->delete($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('TEMPLATE_CATEGORY', $id, ['name' => $category['name'] ?? 'Unknown']);
        
        header('Location: /admin/template');
    }

    // Helper tạo slug (Copy từ TemplateController sang để độc lập)
    private function createSlug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}