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

    // Cập nhật từng key (Insert nếu chưa có)
    public function updateSetting($key, $value) {
        // 1. Kiểm tra tồn tại
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM system_settings WHERE setting_key = :key");
        $stmt->execute([':key' => $key]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            // 2. Update
            $sql = "UPDATE system_settings SET setting_value = :val WHERE setting_key = :key";
        } else {
            // 3. Insert mới (mặc định group 'general')
            $sql = "INSERT INTO system_settings (setting_key, setting_value, setting_group) VALUES (:key, :val, 'general')";
        }

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':val' => $value, ':key' => $key]);
    }
}