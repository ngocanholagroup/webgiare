<?php
// src/controllers/AdminAccountController.php
require_once __DIR__ . '/../config.php';

class AdminAccountController {
    
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }

        $search = htmlspecialchars($_GET['search'] ?? '');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $model = new AdminAccount();
        $totalRecords = $model->countAll($search);
        $admins = $model->getAll($limit, $offset, $search);
        $totalPages = ceil($totalRecords / $limit);

        $tabs = [['id' => 'tab-list', 'label' => 'Danh sách Admin', 'icon' => 'shield']];

        view('admin.account', [
            'title' => 'Quản lý tài khoản',
            'page_tabs' => $tabs,
            'admins' => $admins,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'search' => $search
        ]);
    }

    public function create() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        view('admin.account-form', ['title' => 'Thêm quản trị viên']);
    }

    public function store() {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // Validate CSRF Token
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        $username = htmlspecialchars($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $model = new AdminAccount();

        // 1. Validate
        if ($model->checkUsername($username)) {
            echo "<script>alert('Username đã tồn tại!'); history.back();</script>"; return;
        }
        if (empty($password)) {
            echo "<script>alert('Mật khẩu không được để trống!'); history.back();</script>"; return;
        }

        // 2. Upload Avatar
        $avatarUrl = '';
        if (!empty($_FILES['avatar']['name'])) {
            $avatarUrl = $this->uploadAvatar($_FILES['avatar']);
        }

        // 3. Save
        $data = [
            ':username'  => $username,
            ':password'  => password_hash($password, PASSWORD_DEFAULT),
            ':full_name' => $_POST['full_name'],
            ':email'     => $_POST['email'],
            ':avatar'    => $avatarUrl
        ];
        
        $newId = $model->create($data);
        
        // Log create action
        Logger::getInstance()->logCreate('ADMIN_ACCOUNT', $newId, ['username' => $username, 'email' => $_POST['email']]);
        
        header('Location: /admin/account/edit/' . $newId);
    }

    public function edit($id) {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }
        
        $model = new AdminAccount();
        $admin = $model->getById($id);
        if (!$admin) { echo "Tài khoản không tồn tại"; return; }

        // Không cho sửa admin khác nếu không phải Super Admin (ID=1) 
        // (Logic mở rộng tùy bạn, hiện tại cứ cho sửa hết để test)

        view('admin.account-form', [
            'title' => 'Cập nhật: ' . $admin['username'], 
            'admin' => $admin
        ]);
    }

    public function update($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        // Validate CSRF Token
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            die('CSRF Token không hợp lệ!');
        }

        $model = new AdminAccount();

        // Check trùng username... (giữ nguyên)

        // --- XỬ LÝ AVATAR ---
        // 1. Lấy ảnh cũ từ input hidden (form.php đã tự sinh name='old_avatar')
        $avatarUrl = $_POST['old_avatar'] ?? ''; 

        // 2. Nếu có upload ảnh mới
        if (!empty($_FILES['avatar']['name'])) {
            $newUrl = $this->uploadAvatar($_FILES['avatar']);
            if ($newUrl) {
                // Xóa ảnh cũ trên host để tiết kiệm dung lượng
                if (!empty($avatarUrl)) {
                    MediaService::delete($avatarUrl);
                }
                // Gán đường dẫn mới
                $avatarUrl = $newUrl;
            }
        }
        // --------------------

        $data = [
            ':full_name' => $_POST['full_name'],
            ':email'     => $_POST['email'],
            ':avatar'    => $avatarUrl
        ];
        
        // 4. Xử lý Password (Nếu nhập mới thì đổi)
        if (!empty($_POST['password'])) {
            $data[':password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        
        // Log update action
        Logger::getInstance()->logUpdate('ADMIN_ACCOUNT', $id, ['username' => $model->getById($id)['username'], 'email' => $_POST['email']]);
        
        // Ở lại trang sửa sau khi cập nhật
        header('Location: /admin/account/edit/' . $id);
    }

    public function delete($id) {
        if (!isset($_SESSION['admin_logged_in'])) exit;
        
        if ($_SESSION['admin_id'] == $id) {
            echo "<script>alert('Không thể xóa chính mình!'); window.location='/admin/account';</script>"; return;
        }
        if ($id == 1) { // Bảo vệ tài khoản gốc
            echo "<script>alert('Không thể xóa Super Admin!'); window.location='/admin/account';</script>"; return;
        }

        $model = new AdminAccount();
        // Xóa avatar cũ nếu có
        $admin = $model->getById($id);
        if ($admin && !empty($admin['avatar'])) {
            MediaService::delete($admin['avatar']);
        }

        $model->delete($id);
        
        // Log delete action
        Logger::getInstance()->logDelete('ADMIN_ACCOUNT', $id, ['username' => $admin['username'] ?? 'Unknown']);
        
        header('Location: /admin/account');
    }

    // Helper Upload Avatar
    private function uploadAvatar($file) {
        $result = MediaService::upload($file, 'account'); // Lưu vào thư mục account
        
        if ($result['success']) {
            Logger::getInstance()->logUpload('ADMIN_AVATAR', basename($result['url']), ['size' => $file['size']]);
            return $result['url'];
        }
        
        $_SESSION['upload_error'] = $result['error'];
        return '';
    }
}