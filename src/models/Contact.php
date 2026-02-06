<?php
class Contact {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy danh sách dịch vụ (để đổ ra Dropdown)
    public function getServices() {
        $stmt = $this->conn->query("SELECT * FROM contact_services ORDER BY name ASC");
        return $stmt->fetchAll();
    }

    // Lưu liên hệ mới từ khách
    public function create($data) {
        $sql = "INSERT INTO contacts (full_name, phone, email, service_type, related_template, message, status) 
                VALUES (:name, :phone, :email, :service, :template, :message, 'new')";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name'     => $data['full_name'],
            ':phone'    => $data['phone'],
            ':email'    => $data['email'],
            ':service'  => $data['service_type'],
            ':template' => $data['template_sku'],
            ':message'  => $data['message']
        ]);
    }
}