<?php
// src/models/BlogCategory.php
require_once __DIR__ . '/Database.php';

class BlogCategoryModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy tất cả danh mục
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM blog_categories ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy thông tin 1 danh mục theo slug (để làm tiêu đề SEO)
    public function getBySlug($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM blog_categories WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }
}