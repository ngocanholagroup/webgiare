<?php
// src/models/AdminBlogCategory.php

class AdminBlogCategory {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy chi tiết 1 danh mục
    public function getById($id) {
        $sql = "SELECT * FROM blog_categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Thêm mới
    public function create($data) {
        $sql = "INSERT INTO blog_categories (name, slug) VALUES (:name, :slug)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug']
        ]);
    }

    // Cập nhật
    public function update($id, $data) {
        $sql = "UPDATE blog_categories SET name = :name, slug = :slug WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id'   => $id,
            ':name' => $data['name'],
            ':slug' => $data['slug']
        ]);
    }

    // Xóa
    public function delete($id) {
        $sql = "DELETE FROM blog_categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}