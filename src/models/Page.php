<?php

// src/models/Page.php
require_once __DIR__ . '/Database.php';

class PageModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getPage($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM pages WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        $page = $stmt->fetch();
        
        if ($page) {
            // Giải mã JSON thành mảng PHP để dùng ngoài View
            $page['content'] = json_decode($page['content_json'], true);
        }
        return $page;
    }
}