<?php
class AdminAuthor {
    private $conn;
    public function __construct() { $this->conn = Database::getConnection(); }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM blog_authors WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO blog_authors (name, title, bio, avatar) VALUES (:name, :title, :bio, :avatar)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'], ':title' => $data['title'],
            ':bio' => $data['bio'], ':avatar' => $data['avatar']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE blog_authors SET name=:name, title=:title, bio=:bio, avatar=:avatar WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id, ':name' => $data['name'], ':title' => $data['title'],
            ':bio' => $data['bio'], ':avatar' => $data['avatar']
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM blog_authors WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}