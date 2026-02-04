<?php
// src/models/Setting.php
require_once __DIR__ . '/Database.php';

class SettingModel {
    private $conn;
    
    // Biến tĩnh để lưu cache, tránh query nhiều lần trong 1 trang
    private static $cache = null;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy tất cả setting dưới dạng mảng Key => Value
    public function getAll() {
        // Nếu đã có cache thì trả về luôn, không query nữa
        if (self::$cache !== null) {
            return self::$cache;
        }

        $stmt = $this->conn->prepare("SELECT setting_key, setting_value FROM system_settings");
        $stmt->execute();
        $results = $stmt->fetchAll();

        $data = [];
        foreach ($results as $row) {
            $data[$row['setting_key']] = $row['setting_value'];
        }

        // Lưu vào cache
        self::$cache = $data;
        return $data;
    }
}