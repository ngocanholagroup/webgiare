<?php
// src/controllers/BlogController.php

require_once __DIR__ . '/../models/Database.php'; // Tạm thời require thủ công nếu chưa có autoload

class BlogController {
    public function index() {
        // Giả sử lấy dữ liệu từ DB
        // $db = Database::getConnection();
        // $stmt = $db->query("SELECT * FROM posts LIMIT 5"); // Nhớ tạo bảng posts nhé
        // $posts = $stmt->fetchAll();

        view('client.blog', [
            'title' => 'Tin tức mới nhất',
            // 'posts' => $posts
        ]);
    }

    public function detail($slug) {
        view('client.blog-detail', [
            'title' => 'Chi tiết bài viết',
            'slug' => $slug
        ]);
    }
}