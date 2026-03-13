<?php
require_once __DIR__ . '/../config.php';

class AdminAuthorController {
    // Helper upload ảnh (tái sử dụng từ TemplateController hoặc viết vào BaseController)
    private function uploadImage($file) {
        // Validate file upload
        $validation = FileUploadValidator::validate($file, 'image');
        if (!$validation['valid']) {
            $_SESSION['upload_error'] = implode(', ', $validation['errors']);
            return '';
        }

        $rootPath = dirname(__DIR__); // Points to src/
        $uploadDir = "uploads/authors/";
        $normalizedDir = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($uploadDir, '/'));
        $absoluteUploadDir = $rootPath . DIRECTORY_SEPARATOR . $normalizedDir;

        if (!is_dir($absoluteUploadDir)) {
            if (!mkdir($absoluteUploadDir, 0777, true)) {
                 error_log("Failed to create directory: $absoluteUploadDir");
                 return '';
            }
        }
        
        // Generate safe filename
        $safeFilename = FileUploadValidator::generateSafeFilename($file['name']);
        if (!$safeFilename) {
            $_SESSION['upload_error'] = 'Invalid file extension';
            return '';
        }

        $targetPath = $absoluteUploadDir . DIRECTORY_SEPARATOR . $safeFilename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            Logger::getInstance()->logUpload('AUTHOR_AVATAR', $safeFilename, ['size' => $file['size']]);
            
            // Get base URL for production compatibility
            $baseUrl = Config::getBaseUrl();
            // Web path with forward slashes
            $webPath = '/' . str_replace('\\', '/', $normalizedDir) . '/' . $safeFilename;
            return $baseUrl . $webPath;
        }
        return '';
    }

    public function create() {
        if (!isset($_SESSION['admin_logged_in'])) header('Location: /admin/login');
        view('admin.author-form', ['title' => 'Thêm Tác giả']);
    }

    public function store() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        $data = $_POST;
        $data['avatar'] = !empty($_FILES['avatar']['name']) ? $this->uploadImage($_FILES['avatar']) : '';
        $model = new AdminAuthor();
        $newId = $model->create($data);
        
        // Log create action
        Logger::getInstance()->logCreate('AUTHOR', $newId, ['name' => $data['name']]);
        
        header('Location: /admin/blog/author/edit/' . $newId);
    }

    public function edit($id) {
        if (!isset($_SESSION['admin_logged_in'])) header('Location: /admin/login');
        $author = (new AdminAuthor())->getById($id);
        if (!$author) die('Không tìm thấy');
        view('admin.author-form', ['title' => 'Sửa Tác giả', 'author' => $author]);
    }

    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // CSRF Token validation
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        $data = $_POST;
        $data['avatar'] = $_POST['old_avatar'] ?? '';
        
        $rootPath = dirname(__DIR__); // Points to src/
        
        if (!empty($_FILES['avatar']['name'])) {
            $newUrl = $this->uploadImage($_FILES['avatar']);
            if ($newUrl) {
                $oldPath = ltrim($data['avatar'], '/');
                $absOldPath = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $oldPath);
                
                if(!empty($oldPath) && file_exists($absOldPath) && !is_dir($absOldPath)) unlink($absOldPath);
                $data['avatar'] = $newUrl;
            }
        }
        (new AdminAuthor())->update($id, $data);
        
        // Log update action
        Logger::getInstance()->logUpdate('AUTHOR', $id, ['name' => $data['name']]);
        
        header('Location: /admin/blog/author/edit/' . $id);
    }

    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $model = new AdminAuthor();
        $author = $model->getById($id);
        
        if ($author) {
            $rootPath = dirname(__DIR__); // Points to src/
            $path = ltrim($author['avatar'], '/');
            $absPath = $rootPath . DIRECTORY_SEPARATOR . str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
            
            if (!empty($path) && file_exists($absPath) && !is_dir($absPath)) unlink($absPath);
        }
        
        $model->delete($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('AUTHOR', $id, ['name' => $author['name'] ?? 'Unknown']);
        
        header('Location: /admin/blog');
    }
}