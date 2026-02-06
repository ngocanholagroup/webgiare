<?php
class AdminSetting {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy tất cả setting, trả về mảng Associative ['key' => 'value']
    public function getAllSettings() {
        $stmt = $this->conn->prepare("SELECT setting_key, setting_value FROM system_settings");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $settings = [];
        foreach ($data as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    // Cập nhật từng key
    public function updateSetting($key, $value) {
        $sql = "UPDATE system_settings SET setting_value = :val WHERE setting_key = :key";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':val' => $value, ':key' => $key]);
    }
}