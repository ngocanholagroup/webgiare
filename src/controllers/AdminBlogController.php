<?php
// src/controllers/AdminBlogController.php
require_once __DIR__ . '/../config.php';

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

        // Định nghĩa các tabs
        $page_tabs = [
            ['id' => 'posts', 'label' => 'Bài viết', 'icon' => 'file-text'],
            ['id' => 'categories', 'label' => 'Danh mục', 'icon' => 'folder'],
            ['id' => 'authors', 'label' => 'Tác giả', 'icon' => 'users']
        ];

        view('admin.blog', [
            'title' => 'Quản lý Blog',
            'posts' => $posts,
            'categories' => $categories,
            'authors' => $authors,
            'page' => $page,
            'totalPages' => $totalPages,
            'search' => $search,
            'totalRecords' => $totalRecords,
            'page_tabs' => $page_tabs,
            'active_tab' => 'posts'
        ]);
    }

    // 2. UPLOAD ẢNH CHO TINYMCE
    public function uploadTinyMCE()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        if (!isset($_FILES['file'])) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'No file uploaded']);
            exit;
        }

        // Upload vào thư mục blog
        $result = MediaService::upload($_FILES['file'], 'blog');

        if ($result['success']) {
            header('Content-Type: application/json');
            echo json_encode(['location' => $result['url']]);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => $result['error']]);
        }
        exit;
    }

    // 3. FORM TẠO MỚI
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

    // 4. XỬ LÝ LƯU (STORE)
    public function store()
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }
        
        $data = $_POST;
        
        // Validate reading_time - must be integer, default to 5 if empty
        $val_reading_time = $data['reading_time'] ?? '';
        $data['reading_time'] = ($val_reading_time !== '' && is_numeric($val_reading_time)) ? (int)$val_reading_time : 5;
        
        // Validate other required fields
        if (empty($data['title'])) {
            die('Tiêu đề bài viết là bắt buộc!');
        }
        if (empty($data['category_id'])) {
            die('Danh mục là bắt buộc!');
        }
        if (empty($data['author_id'])) {
            die('Tác giả là bắt buộc!');
        }
        
        // Tạo slug tự động
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['title']);
        }

        // Upload Thumbnail
        $data['thumbnail'] = '';
        if (!empty($_FILES['thumbnail']['name'])) {
            $data['thumbnail'] = $this->uploadImage($_FILES['thumbnail']);
        }

        // Tạo bài viết mới
        $postId = (new AdminBlog())->createPost($data);
        
        // Log create action
        Logger::getInstance()->logCreate('BLOG_POST', $postId, ['title' => $data['title']]);
        
        // Chuyển hướng sang trang sửa bài vừa tạo
        header('Location: /admin/blog/edit/' . $postId);
    }

    // 5. FORM SỬA (EDIT)
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

    // 6. XỬ LÝ CẬP NHẬT (UPDATE)
    public function update($id)
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }
        
        $model = new AdminBlog();
        
        // 1. Lấy bài viết CŨ trong DB
        $oldPost = $model->getPostById($id);
        if (!$oldPost) die('Post not found');

        $data = $_POST;
        
        // Validate reading_time - must be integer, default to 5 if empty
        $val_reading_time = $data['reading_time'] ?? '';
        $data['reading_time'] = ($val_reading_time !== '' && is_numeric($val_reading_time)) ? (int)$val_reading_time : 5;
        
        if (empty($data['slug'])) {
            $data['slug'] = $this->createSlug($data['title']);
        }

        $rootPath = dirname(__DIR__); // Points to src/

        // Xử lý Thumbnail
        $data['thumbnail'] = $_POST['old_thumbnail'] ?? '';
        
        if (!empty($_FILES['thumbnail']['name'])) {
            $newUrl = $this->uploadImage($_FILES['thumbnail']);
            if ($newUrl) {
                if (!empty($data['thumbnail'])) {
                    MediaService::delete($data['thumbnail']);
                }
                $data['thumbnail'] = $newUrl;
            }
        }

        // Lấy danh sách ảnh trong nội dung CŨ
        $oldImages = $this->getImagesFromContent($oldPost['content']);
        
        // Lấy danh sách ảnh trong nội dung MỚI
        $newImages = $this->getImagesFromContent($data['content']);
        
        // Tìm những ảnh có trong CŨ mà KHÔNG có trong MỚI (tức là đã bị user xóa)
        $deletedImages = array_diff($oldImages, $newImages);
        
        foreach ($deletedImages as $imgUrl) {
            MediaService::delete($imgUrl);
        }

        (new AdminBlog())->updatePost($id, $data);
        
        // Log update action
        Logger::getInstance()->logUpdate('BLOG_POST', $id, ['title' => $data['title']]);
        
        // Ở lại trang sửa sau khi cập nhật
        header('Location: /admin/blog/edit/' . $id);
    }

    // 7. XỬ LÝ XÓA (DELETE)
    public function delete($id) 
    {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        $model = new AdminBlog();
        $post = $model->getPostById($id);
        
        if ($post) {
            $rootPath = dirname(__DIR__); // Points to src/

            // 1. Xóa Thumbnail (Media Server)
            if (!empty($post['thumbnail'])) {
                MediaService::delete($post['thumbnail']);
            }

            // 2. Xóa toàn bộ ảnh trong nội dung bài viết (Media Server)
            $contentImages = $this->getImagesFromContent($post['content']);
            foreach ($contentImages as $imgUrl) {
                MediaService::delete($imgUrl);
            }
        }

        $model->deletePost($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('BLOG_POST', $id, ['title' => $post['title'] ?? 'Unknown']);
        
        header('Location: /admin/blog');
    }

    // --- HELPER FUNCTIONS ---

    // [MỚI] Hàm xử lý upload ảnh từ CKEditor
    public function uploadCKEditor()
    {
        // 1. Kiểm tra quyền Admin
        if (!isset($_SESSION['admin_logged_in'])) {
            http_response_code(403);
            echo json_encode(['error' => ['message' => 'Unauthorized']]);
            exit;
        }

        // 2. Kiểm tra file gửi lên (Name mặc định của CKEditor là 'upload')
        if (!isset($_FILES['upload'])) {
            http_response_code(400);
            echo json_encode(['error' => ['message' => 'Upload failed.']]);
            exit;
        }

        $result = MediaService::upload($_FILES['upload']);

        if ($result['success']) {
            Logger::getInstance()->logUpload('CKEDITOR_IMAGE', basename($result['url']), ['size' => $_FILES['upload']['size']]);
            echo json_encode([
                'url' => $result['url'] 
            ]);
        } else {
            echo json_encode(['error' => ['message' => $result['error']]]);
        }
        exit;
    }

    // Hàm upload ảnh vào folder uploads/blog/
    private function uploadImage($file)
    {
        $result = MediaService::upload($file, 'blog'); // Lưu vào thư mục blog
        
        if ($result['success']) {
            // Log file upload
            Logger::getInstance()->logUpload('BLOG_IMAGE', basename($result['url']), ['size' => $file['size']]);
            return $result['url'];
        }
        
        $_SESSION['upload_error'] = $result['error'];
        return '';
    }

    // Hàm tách lấy tất cả đường dẫn ảnh trong nội dung HTML
    private function getImagesFromContent($html)
    {
        $images = [];
        // Regex tìm tất cả src="..."
        preg_match_all('/src="([^"]+)"/', $html, $matches);
        
        if (!empty($matches[1])) {
            return array_unique($matches[1]);
        }
        return [];
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
