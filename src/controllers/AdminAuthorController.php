<?php
require_once __DIR__ . '/../config.php';

class AdminAuthorController {
    // Helper upload ảnh (tái sử dụng từ TemplateController hoặc viết vào BaseController)
    private function uploadImage($file) {
        $result = MediaService::upload($file, 'author'); // Lưu vào thư mục author
        
        if ($result['success']) {
            Logger::getInstance()->logUpload('AUTHOR_AVATAR', basename($result['url']), ['size' => $file['size']]);
            return $result['url'];
        }
        
        $_SESSION['upload_error'] = $result['error'];
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
        
        header('Location: /admin/author/edit/' . $newId);
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
                if (!empty($data['avatar'])) {
                    MediaService::delete($data['avatar']);
                }
                $data['avatar'] = $newUrl;
            }
        }
        (new AdminAuthor())->update($id, $data);
        
        // Log update action
        Logger::getInstance()->logUpdate('AUTHOR', $id, ['name' => $data['name']]);
        
        header('Location: /admin/author/edit/' . $id);
    }

    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $model = new AdminAuthor();
        $author = $model->getById($id);
        
        if ($author) {
            if (!empty($author['avatar'])) {
                MediaService::delete($author['avatar']);
            }
        }
        
        $model->delete($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('AUTHOR', $id, ['name' => $author['name'] ?? 'Unknown']);
        
        header('Location: /admin/blog');
    }
}