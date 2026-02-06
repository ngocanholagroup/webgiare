<?php
// src/models/AdminTemplateCategory.php

class AdminTemplateCategory {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy tất cả danh mục (để hiện list)
    public function getAll() {
        // Có thể đếm thêm số lượng template trong mỗi danh mục
        $sql = "SELECT c.*, COUNT(t.id) as total_templates 
                FROM template_categories c 
                LEFT JOIN templates t ON c.id = t.category_id 
                GROUP BY c.id 
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy chi tiết 1 danh mục (để sửa)
    public function getById($id) {
        $sql = "SELECT * FROM template_categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Thêm mới
    public function create($data) {
        $sql = "INSERT INTO template_categories (name, slug, description) VALUES (:name, :slug, :description)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':description' => $data['description']
        ]);
    }

    // Cập nhật
    public function update($id, $data) {
        $sql = "UPDATE template_categories SET name = :name, slug = :slug, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':slug' => $data['slug'],
            ':description' => $data['description']
        ]);
    }

    // Xóa
    public function delete($id) {
        $sql = "DELETE FROM template_categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}