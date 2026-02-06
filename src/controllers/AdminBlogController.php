<?php
// src/controllers/AdminBlogController.php

class AdminBlogController
{
    // 1. DANH SÁCH (INDEX)
    public function index()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin/login');
            exit;
        }

        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $model = new AdminBlog();

        // Data cho Tab 1: Bài viết
        $totalRecords = $model->countAllPosts($search);
        $posts = $model->getAllPosts($limit, $offset, $search);
        $totalPages = ceil($totalRecords / $limit);

        // Data cho Tab 2: Danh mục
        $categories = $model->getCategoriesWithStats();

        // Data cho Tab 3: Tác giả
        $authors = $model->getAuthorsWithStats();

        $tabs = [
            ['id' => 'tab-posts', 'label' => 'Bài viết', 'icon' => 'file-text'],
            ['id' => 'tab-categories', 'label' => 'Danh mục', 'icon' => 'folder-open'],
            ['id' => 'tab-authors', 'label' => 'Tác giả', 'icon' => 'users']
        ];

        view('admin.blog', [
            'title' => 'Quản lý Blog',
            'page_tabs' => $tabs,
            'posts' => $posts,
            'categories' => $categories,
            'authors' => $authors,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'search' => $search
        ]);
    }

    // 2. FORM TẠO MỚI
    public function create()
    {
        if (!isset($_SESSION['admin_logged_in'])) header('Location: /admin/login');
        
        $model = new AdminBlog();
        view('admin.blog-form', [
            'title' => 'Viết bài mới',
            'categories' => $model->getCategoriesSimple(),
            'authors' => $model->getAuthorsSimple()
        ]);
    }

    // 3. XỬ LÝ LƯU (STORE)
    public function store()
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $data = $_POST;
        
        // Tạo slug tự động
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['title']);
        }

        // Upload Thumbnail
        $data['thumbnail'] = '';
        if (!empty($_FILES['thumbnail']['name'])) {
            $data['thumbnail'] = $this->uploadImage($_FILES['thumbnail']);
        }

        (new AdminBlog())->createPost($data);
        header('Location: /admin/blog');
    }

    // 4. FORM SỬA (EDIT)
    public function edit($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) header('Location: /admin/login');
        
        $model = new AdminBlog();
        $post = $model->getPostById($id);
        
        if (!$post) die('Không tìm thấy bài viết');

        view('admin.blog-form', [
            'title' => 'Sửa bài viết',
            'post' => $post,
            'categories' => $model->getCategoriesSimple(),
            'authors' => $model->getAuthorsSimple()
        ]);
    }

    // 5. XỬ LÝ CẬP NHẬT (UPDATE)
    public function update($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $data = $_POST;
        
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['title']);
        }

        // Xử lý Thumbnail
        $data['thumbnail'] = $_POST['old_thumbnail'] ?? '';
        
        if (!empty($_FILES['thumbnail']['name'])) {
            $newUrl = $this->uploadImage($_FILES['thumbnail']);
            if ($newUrl) {
                // Xóa ảnh cũ để dọn rác server
                $oldFile = ltrim($data['thumbnail'], '/');
                if (!empty($oldFile) && file_exists($oldFile)) {
                    unlink($oldFile);
                }
                $data['thumbnail'] = $newUrl;
            }
        }

        (new AdminBlog())->updatePost($id, $data);
        header('Location: /admin/blog');
    }

    // 6. XỬ LÝ XÓA (DELETE) - Bổ sung hàm này vì code cũ bạn thiếu
    public function delete($id) 
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $model = new AdminBlog();
        
        // Lấy thông tin bài viết để xóa ảnh thumbnail
        $post = $model->getPostById($id);
        if ($post) {
            $thumb = ltrim($post['thumbnail'], '/');
            if (!empty($thumb) && file_exists($thumb)) {
                unlink($thumb);
            }
        }

        $model->deletePost($id);
        header('Location: /admin/blog');
    }

    // --- HELPER FUNCTIONS ---

    // Hàm upload ảnh vào folder uploads/blog/
    private function uploadImage($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return '';

        $targetDir = "uploads/blog/";
        // Tự tạo thư mục nếu chưa có
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Đổi tên file để tránh trùng: time_random.ext
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = time() . '_' . rand(1000, 9999) . '.' . $ext;
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return '/' . $targetPath;
        }
        return '';
    }

    // Hàm tạo slug tiếng Việt
    private function createSlug($str)
    {
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