<?php
// src/models/AdminAccount.php
class AdminAccount {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function countAll($search = '') {
        $sql = "SELECT COUNT(*) as total FROM admins WHERE 1=1";
        $params = [];
        if (!empty($search)) {
            $sql .= " AND (username LIKE :s OR full_name LIKE :s OR email LIKE :s)";
            $params[':s'] = "%$search%";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    public function getAll($limit, $offset, $search = '') {
        $sql = "SELECT * FROM admins WHERE 1=1";
        $params = [];
        if (!empty($search)) {
            $sql .= " AND (username LIKE :s OR full_name LIKE :s OR email LIKE :s)";
            $params[':s'] = "%$search%";
        }
        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $value) $stmt->bindValue($key, $value);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Kiểm tra username đã tồn tại chưa (trừ chính user đang sửa)
    public function checkUsername($username, $excludeId = null) {
        $sql = "SELECT count(*) FROM admins WHERE username = :username";
        $params = [':username' => $username];
        
        if ($excludeId) {
            $sql .= " AND id != :id";
            $params[':id'] = $excludeId;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    public function create($data) {
        $sql = "INSERT INTO admins (username, password, full_name, email, avatar) 
                VALUES (:username, :password, :full_name, :email, :avatar)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $sql = "UPDATE admins SET full_name = :full_name, email = :email, avatar = :avatar";
        
        // Kiểm tra xem trong data có key :password không (do Controller xử lý)
        if (array_key_exists(':password', $data)) {
            $sql .= ", password = :password";
        }
        
        $sql .= " WHERE id = :id";
        
        $data[':id'] = $id; // Thêm ID vào mảng data để bind
        
        // Lưu ý: Controller của mình đang truyền key có dấu hai chấm (VD: ':full_name')
        // Nên ở đây mình bind thẳng mảng $data vào execute luôn là được.
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM admins WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}