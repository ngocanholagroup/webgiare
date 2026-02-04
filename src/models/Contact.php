<?php
// src/models/Contact.php
require_once __DIR__ . '/Database.php';

class ContactModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lưu liên hệ mới
    public function create($data) {
        $sql = "INSERT INTO contacts (full_name, phone, email, service_type, related_template, message) 
                VALUES (:name, :phone, :email, :service, :template, :msg)";
        
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            ':name'     => $data['full_name'],
            ':phone'    => $data['phone'],
            ':email'    => $data['email'] ?? null,
            ':service'  => $data['service_type'],
            ':template' => $data['related_template'] ?? null,
            ':msg'      => $data['message']
        ]);
    }
}