<?php
// src/controllers/AdminAccountController.php

class AdminAccountController {
    
    public function index() {
        if (!isset($_SESSION['admin_logged_in'])) { header('Location: /admin/login'); exit; }

        $search = $_GET['search'] ?? '';
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

        $username = $_POST['username'];
        $password = $_POST['password'];
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
        
        $model->create($data);
        header('Location: /admin/account');
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
                    $oldFile = ltrim($avatarUrl, '/'); // Xóa dấu / đầu tiên
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
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
        header('Location: /admin/account');
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
        if ($admin && !empty($admin['avatar']) && file_exists(ltrim($admin['avatar'], '/'))) {
            unlink(ltrim($admin['avatar'], '/'));
        }

        $model->delete($id);
        header('Location: /admin/account');
    }

    // Helper Upload Avatar
    private function uploadAvatar($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) return '';
        $targetDir = "uploads/avatars/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        
        $fileName = time() . '_' . rand(1000, 9999) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        if (move_uploaded_file($file['tmp_name'], $targetDir . $fileName)) {
            return '/' . $targetDir . $fileName;
        }
        return '';
    }
}