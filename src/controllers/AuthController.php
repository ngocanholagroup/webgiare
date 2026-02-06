<?php
// src/controllers/AuthController.php
require_once __DIR__ . '/../models/Admin.php';

class AuthController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // Hiển thị form login (GET)
    public function login() {
        // Nếu đã login rồi thì đá về trang admin
        if (isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin');
            exit;
        }
        
        require __DIR__ . '/../views/admin/login.php';
    }

    // Xử lý đăng nhập (POST)
    public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = '';

        if (empty($username) || empty($password)) {
            $error = 'Vui lòng nhập đầy đủ thông tin!';
        } else {
            $admin = $this->adminModel->authenticate($username, $password);

            if ($admin) {
                // Đăng nhập thành công -> Lưu Session
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_avatar'] = $admin['avatar'];

                header('Location: /admin');
                exit;
            } else {
                $error = 'Tài khoản hoặc mật khẩu không chính xác!';
            }
        }

        // Nếu lỗi, load lại view kèm thông báo lỗi
        require __DIR__ . '/../views/admin/login.php';
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}