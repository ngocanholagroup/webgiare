<?php
class AdminPage {
    private $conn;
    public function __construct() { $this->conn = Database::getConnection(); }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM pages ORDER BY name ASC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM pages WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $sql = "UPDATE pages SET 
                name = :name, 
                meta_title = :meta_title, 
                meta_desc = :meta_desc, 
                content_json = :content_json 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':meta_title' => $data['meta_title'],
            ':meta_desc' => $data['meta_desc'],
            ':content_json' => $data['content_json']
        ]);
    }
}