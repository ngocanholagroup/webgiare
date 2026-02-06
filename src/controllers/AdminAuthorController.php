<?php
class AdminAuthorController {
    // Helper upload ảnh (tái sử dụng từ TemplateController hoặc viết vào BaseController)
    private function uploadImage($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) return '';
        $targetDir = "uploads/authors/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $fileName = time() . '_' . rand(1000, 9999) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        if (move_uploaded_file($file['tmp_name'], $targetDir . $fileName)) return '/' . $targetDir . $fileName;
        return '';
    }

    public function create() {
        if (!isset($_SESSION['admin_logged_in'])) header('Location: /admin/login');
        view('admin.author-form', ['title' => 'Thêm Tác giả']);
    }

    public function store() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $data = $_POST;
        $data['avatar'] = !empty($_FILES['avatar']['name']) ? $this->uploadImage($_FILES['avatar']) : '';
        (new AdminAuthor())->create($data);
        header('Location: /admin/blog?tab=authors');
    }

    public function edit($id) {
        if (!isset($_SESSION['admin_logged_in'])) header('Location: /admin/login');
        $author = (new AdminAuthor())->getById($id);
        if (!$author) die('Không tìm thấy');
        view('admin.author-form', ['title' => 'Sửa Tác giả', 'author' => $author]);
    }

    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
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
        header('Location: /admin/blog?tab=authors');
    }

    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        $model = new AdminAuthor();
        $author = $model->getById($id);
        if ($author && file_exists(ltrim($author['avatar'], '/'))) unlink(ltrim($author['avatar'], '/'));
        $model->delete($id);
        header('Location: /admin/blog?tab=authors');
    }
}