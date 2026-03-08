<?php
// src/controllers/AuthController.php
require_once __DIR__ . '/../models/Auth.php';
require_once __DIR__ . '/../SecurityHelper.php';

class AuthController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    // Hiển thị form login (GET)
    public function login() {
        // Nếu đã login rồi thì đá về trang admin
        if (isset($_SESSION['admin_logged_in'])) {
            header('Location: /admin');
            exit;
        }
        
        // Tạo CSRF token
        SecurityHelper::generateCSRFToken();
        
        require __DIR__ . '/../views/admin/login.php';
    }

    // Xử lý đăng nhập (POST)
    public function handleLogin() {
        // 1. Kiểm tra CSRF Token
        if (!SecurityHelper::verifyCSRFToken()) {
            http_response_code(403);
            $error = 'CSRF Token không hợp lệ! Vui lòng thử lại.';
            SecurityHelper::generateCSRFToken();
            require __DIR__ . '/../views/admin/login.php';
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = '';

        if (empty($username) || empty($password)) {
            $error = 'Vui lòng nhập đầy đủ thông tin!';
        } else {
            // 2. Kiểm tra Brute Force
            if (SecurityHelper::isLoginLocked($username)) {
                $error = 'Tài khoản đã bị khóa do nhập sai nhiều lần. Vui lòng thử lại sau 15 phút.';
            } else {
                $admin = $this->authModel->authenticate($username, $password);

                if ($admin) {
                    // Đăng nhập thành công -> Lưu Session
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_name'] = $admin['full_name'];
                    $_SESSION['admin_avatar'] = $admin['avatar'];
                    
                    // Log successful login
                    Logger::getInstance()->logLogin(true);
                    
                    // Xóa failed login attempts
                    SecurityHelper::clearFailedLogins($username);
                    
                    // Initialize session security
                    SecurityHelper::checkSessionTimeout();

                    header('Location: /admin');
                    exit;
                } else {
                    // Record failed login
                    SecurityHelper::recordFailedLogin($username);
                    
                    // Log failed login
                    Logger::getInstance()->logLogin(false);
                    
                    $error = 'Tài khoản hoặc mật khẩu không chính xác!';
                }
            }
        }

        // Nếu lỗi, load lại view kèm thông báo lỗi
        SecurityHelper::generateCSRFToken();
        require __DIR__ . '/../views/admin/login.php';
    }

    // Đăng xuất
    public function logout() {
        Logger::getInstance()->logLogout();
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}