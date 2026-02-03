<?php
// src/models/TemplateCategory.php

require_once __DIR__ . '/Database.php';

class TemplateCategoryModel { // Đổi tên class
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Lấy tất cả danh mục
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM template_categories ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy thông tin 1 danh mục theo slug
    public function getBySlug($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM template_categories WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }
}