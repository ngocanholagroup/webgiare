<?php
require_once __DIR__ . '/Database.php';

class BlogCategoryModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        // Lấy danh mục và đếm số bài viết trong mỗi danh mục
        $sql = "SELECT c.*, COUNT(p.id) as total_posts 
                FROM blog_categories c
                LEFT JOIN blog_posts p ON c.id = p.category_id AND p.status = 1
                GROUP BY c.id
                ORDER BY c.name ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}