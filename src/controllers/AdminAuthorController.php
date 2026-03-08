<?php
class AdminAuthorController {
    // Helper upload ảnh (tái sử dụng từ TemplateController hoặc viết vào BaseController)
    private function uploadImage($file) {
        // Validate file upload
        $validation = FileUploadValidator::validate($file, 'image');
        if (!$validation['valid']) {
            $_SESSION['upload_error'] = implode(', ', $validation['errors']);
            return '';
        }

        $targetDir = "uploads/authors/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        
        // Generate safe filename
        $safeFilename = FileUploadValidator::generateSafeFilename($file['name']);
        if (!$safeFilename) {
            $_SESSION['upload_error'] = 'Invalid file extension';
            return '';
        }

        if (move_uploaded_file($file['tmp_name'], $targetDir . $safeFilename)) {
            Logger::getInstance()->logUpload('AUTHOR_AVATAR', $safeFilename, ['size' => $file['size']]);
            return '/' . $targetDir . $safeFilename;
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
        if (!empty($_FILES['avatar']['name'])) {
            $newUrl = $this->uploadImage($_FILES['avatar']);
            if ($newUrl) {
                if(file_exists(ltrim($data['avatar'], '/'))) unlink(ltrim($data['avatar'], '/'));
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
        if ($author && file_exists(ltrim($author['avatar'], '/'))) unlink(ltrim($author['avatar'], '/'));
        $model->delete($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('AUTHOR', $id, ['name' => $author['name'] ?? 'Unknown']);
        
        header('Location: /admin/blog');
    }
}