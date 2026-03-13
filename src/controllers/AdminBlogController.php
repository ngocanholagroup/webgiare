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

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'No file uploaded']);
            exit;
        }

        $file = $_FILES['file'];
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        // Validate file type
        if (!in_array($file['type'], $allowedTypes)) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'Invalid file type. Only JPEG, PNG, GIF, WebP allowed.']);
            exit;
        }

        // Validate file size
        if ($file['size'] > $maxSize) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'File too large. Maximum size is 5MB.']);
            exit;
        }

        // Create upload directory if not exists
        $rootPath = dirname(__DIR__); // Points to src/
        $uploadDir = 'uploads/blog/';
        $normalizedDir = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($uploadDir, '/'));
        $absoluteUploadDir = $rootPath . DIRECTORY_SEPARATOR . $normalizedDir;

        if (!is_dir($absoluteUploadDir)) {
            if (!mkdir($absoluteUploadDir, 0777, true)) {
                $error = error_get_last();
                error_log("Failed to create directory: $absoluteUploadDir. Error: " . ($error['message'] ?? 'Unknown'));
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['error' => 'Failed to create upload directory: ' . $absoluteUploadDir]);
                exit;
            }
        }
        
        // Ensure directory is writable
        if (!is_writable($absoluteUploadDir)) {
             chmod($absoluteUploadDir, 0777);
             if (!is_writable($absoluteUploadDir)) {
                 error_log("Directory not writable: $absoluteUploadDir");
                 header('HTTP/1.1 500 Internal Server Error');
                 echo json_encode(['error' => 'Upload directory is not writable']);
                 exit;
             }
        }

        // Create additional upload directories (ensure they exist)
        $additionalDirs = [
            'uploads/posts_content/',
            'uploads/templates/',
            'uploads/temp/'
        ];
        
        foreach ($additionalDirs as $dir) {
            $norm = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($dir, '/'));
            $abs = $rootPath . DIRECTORY_SEPARATOR . $norm;
            if (!is_dir($abs)) {
                mkdir($abs, 0777, true);
            }
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'blog_' . time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $absoluteUploadDir . DIRECTORY_SEPARATOR . $filename;

        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Return file URL with base URL for production compatibility
            $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
            // Always forward slashes for URL
            $webPath = '/' . str_replace('\\', '/', $normalizedDir) . '/' . $filename;
            $fileUrl = $baseUrl . $webPath;
            
            header('Content-Type: application/json');
            echo json_encode(['location' => $fileUrl]);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => 'Failed to move uploaded file']);
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
                // Xóa ảnh cũ để dọn rác server
                $oldFile = ltrim($data['thumbnail'], '/');
                $absOldFile = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $oldFile);
                if (!empty($oldFile) && file_exists($absOldFile) && !is_dir($absOldFile)) {
                    unlink($absOldFile);
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
        
        // Tiến hành xóa file vật lý
        foreach ($deletedImages as $img) {
            $absImg = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $img);
            if (file_exists($absImg) && !is_dir($absImg)) {
                unlink($absImg);
            }
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

            // 1. Xóa Thumbnail (Code cũ đã có)
            $thumb = ltrim($post['thumbnail'], '/');
            $absThumb = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $thumb);
            if (!empty($thumb) && file_exists($absThumb) && !is_dir($absThumb)) {
                unlink($absThumb);
            }

            // 2. [MỚI] Xóa toàn bộ ảnh trong nội dung bài viết
            $contentImages = $this->getImagesFromContent($post['content']);
            foreach ($contentImages as $img) {
                $absImg = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $img);
                if (file_exists($absImg) && !is_dir($absImg)) {
                    unlink($absImg);
                }
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
        if (!isset($_FILES['upload']) || $_FILES['upload']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['error' => ['message' => 'Upload failed.']]);
            exit;
        }

        $file = $_FILES['upload'];
        
        // 3. Validate file using FileUploadValidator
        $validation = FileUploadValidator::validate($file, 'image');
        if (!$validation['valid']) {
            http_response_code(400);
            echo json_encode(['error' => ['message' => implode(', ', $validation['errors'])]]);
            exit;
        }
        
        // 4. Create upload directory if not exists
        $rootPath = dirname(__DIR__); // Points to src/
        $uploadDir = 'uploads/posts_content/';
        $normalizedDir = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($uploadDir, '/'));
        $absoluteUploadDir = $rootPath . DIRECTORY_SEPARATOR . $normalizedDir;
        
        if (!is_dir($absoluteUploadDir)) {
            if (!mkdir($absoluteUploadDir, 0777, true)) {
                http_response_code(500);
                echo json_encode(['error' => ['message' => 'Failed to create directory. Permission denied.']]);
                exit;
            }
        }
        
        // 5. Generate safe filename
        $safeFilename = FileUploadValidator::generateSafeFilename($file['name']);
        if (!$safeFilename) {
            http_response_code(400);
            echo json_encode(['error' => ['message' => 'Invalid file extension']]);
            exit;
        }
        
        $targetPath = $absoluteUploadDir . DIRECTORY_SEPARATOR . $safeFilename;
        
        // 6. Move file to target directory
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Log upload
            Logger::getInstance()->logUpload('CKEDITOR_IMAGE', $safeFilename, ['size' => $file['size']]);
            
            // 7. Trả về JSON đúng chuẩn CKEditor 5
            // Đường dẫn web (luôn dùng forward slash)
            $webPath = '/' . str_replace('\\', '/', $normalizedDir) . '/' . $safeFilename;
            echo json_encode([
                'url' => $webPath 
            ]);
        } else {
            echo json_encode(['error' => ['message' => 'Không thể lưu file vào server.']]);
        }
        exit;
    }

    // Hàm upload ảnh vào folder uploads/blog/
    private function uploadImage($file)
    {
        // Validate file upload
        $validation = FileUploadValidator::validate($file, 'image');
        if (!$validation['valid']) {
            $_SESSION['upload_error'] = implode(', ', $validation['errors']);
            return '';
        }

        $rootPath = dirname(__DIR__); // Points to src/
        $uploadDir = 'uploads/blog/';
        $normalizedDir = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($uploadDir, '/'));
        $absoluteUploadDir = $rootPath . DIRECTORY_SEPARATOR . $normalizedDir;

        // Tự tạo thư mục nếu chưa có
        if (!is_dir($absoluteUploadDir)) {
            mkdir($absoluteUploadDir, 0777, true);
        }

        // Generate safe filename
        $safeFilename = FileUploadValidator::generateSafeFilename($file['name']);
        if (!$safeFilename) {
            $_SESSION['upload_error'] = 'Invalid file extension';
            return '';
        }

        $targetPath = $absoluteUploadDir . DIRECTORY_SEPARATOR . $safeFilename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Log file upload
            Logger::getInstance()->logUpload('BLOG_IMAGE', $safeFilename, ['size' => $file['size']]);
            
            // Return relative web path
            return '/' . str_replace('\\', '/', $normalizedDir) . '/' . $safeFilename;
        }
        return '';
    }

    // Hàm tách lấy tất cả đường dẫn ảnh trong nội dung HTML
    private function getImagesFromContent($html)
    {
        $images = [];
        // Regex tìm tất cả src="..."
        preg_match_all('/src="([^"]+)"/', $html, $matches);
        
        if (!empty($matches[1])) {
            foreach ($matches[1] as $src) {
                // Chỉ lấy những ảnh nằm trong folder uploads của mình
                // (Tránh xóa nhầm ảnh từ link ngoài hoặc ảnh giao diện)
                if (strpos($src, '/uploads/posts_content/') !== false) {
                    // Loại bỏ tên miền nếu có, chỉ lấy đường dẫn tương đối từ root
                    $path = parse_url($src, PHP_URL_PATH);
                    $images[] = ltrim($path, '/'); // Xóa dấu / ở đầu để dùng với hàm unlink
                }
            }
        }
        return array_unique($images);
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
