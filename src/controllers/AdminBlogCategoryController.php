<?php
// src/controllers/AdminBlogCategoryController.php

class AdminBlogCategoryController {
    
    // 1. Form Tạo mới
    public function create() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        view('admin.blog-category-form', [
            'title' => 'Thêm Danh mục Blog'
        ]);
    }

    // 2. Xử lý Lưu (Store)
    public function store() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $data = $_POST;
        
        // Validate
        if (empty($data['name'])) {
            header('Location: /admin/blog-category/create'); 
            exit;
        }

        // Auto Slug
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['name']);
        }

        $model = new AdminBlogCategory();
        $model->create($data);

        // Quay về trang Blog, tab Categories
        header('Location: /admin/blog?tab=categories');
    }

    // 3. Form Sửa (Edit)
    public function edit($id) {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        $model = new AdminBlogCategory();
        $category = $model->getById($id);

        if (!$category) { echo "Danh mục không tồn tại"; return; }

        view('admin.blog-category-form', [
            'title' => 'Cập nhật Danh mục',
            'category' => $category
        ]);
    }

    // 4. Xử lý Cập nhật (Update)
    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $data = $_POST;
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['name']);
        }

        $model = new AdminBlogCategory();
        $model->update($id, $data);

        header('Location: /admin/blog?tab=categories');
    }

    // 5. Xóa
    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $model = new AdminBlogCategory();
        $model->delete($id);
        
        header('Location: /admin/blog?tab=categories');
    }

    // Helper tạo slug
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