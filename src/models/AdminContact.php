<?php
// src/models/AdminContact.php
class AdminContact {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // --- PHẦN 1: LOGIC LIÊN HỆ (CONTACTS) ---
    
    // [CẬP NHẬT] Lấy danh sách dịch vụ từ bảng mới contact_services
    public function getServiceTypes() {
        $stmt = $this->conn->prepare("SELECT * FROM contact_services ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countAll($search = '', $status = '', $service = '') {
        $sql = "SELECT COUNT(*) as total FROM contacts WHERE 1=1";
        $params = [];
        if (!empty($search)) {
            $sql .= " AND (full_name LIKE :s OR phone LIKE :s OR email LIKE :s)";
            $params[':s'] = "%$search%";
        }
        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }
        if (!empty($service)) {
            $sql .= " AND service_type = :service";
            $params[':service'] = $service;
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    public function getAll($limit, $offset, $search = '', $status = '', $service = '') {
        $sql = "SELECT * FROM contacts WHERE 1=1";
        $params = [];
        // (Giữ nguyên logic search như cũ)
        if (!empty($search)) {
            $sql .= " AND (full_name LIKE :s OR phone LIKE :s OR email LIKE :s)";
            $params[':s'] = "%$search%";
        }
        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }
        if (!empty($service)) {
            $sql .= " AND service_type = :service";
            $params[':service'] = $service;
        }
        $sql .= " ORDER BY CASE WHEN status = 'new' THEN 0 ELSE 1 END, created_at DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $value) $stmt->bindValue($key, $value);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function update($id, $data) {
        $sql = "UPDATE contacts SET status = :status, admin_note = :note WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':status' => $data['status'],
            ':note' => $data['admin_note']
        ]);
    }

    // --- PHẦN 2: LOGIC QUẢN LÝ DỊCH VỤ (SERVICES) ---

    public function addService($name) {
        $stmt = $this->conn->prepare("INSERT INTO contact_services (name) VALUES (:name)");
        return $stmt->execute([':name' => $name]);
    }

    public function deleteService($id) {
        $stmt = $this->conn->prepare("DELETE FROM contact_services WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}