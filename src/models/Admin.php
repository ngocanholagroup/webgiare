<?php
// src/models/Admin.php
require_once __DIR__ . '/Database.php';

class AdminModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Hàm kiểm tra đăng nhập
    public function authenticate($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch();

        // 1. Kiểm tra có user không
        // 2. Kiểm tra mật khẩu hash có khớp không
        if ($admin && password_verify($password, $admin['password'])) {
            
            // Cập nhật thời gian đăng nhập cuối
            $this->updateLastLogin($admin['id']);
            
            // Xóa mật khẩu khỏi mảng trước khi trả về (để an toàn session)
            unset($admin['password']);
            return $admin;
        }

        return false;
    }

    private function updateLastLogin($id) {
        $stmt = $this->conn->prepare("UPDATE admins SET last_login = NOW() WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}