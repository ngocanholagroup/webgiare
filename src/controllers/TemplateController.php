<?php
// src/controllers/TemplateController.php

require_once __DIR__ . '/../models/Database.php'; // Tạm thời require thủ công nếu chưa có autoload

class TemplateController {
    public function index() {
        // Giả sử lấy dữ liệu từ DB
        // $db = Database::getConnection();
        // $stmt = $db->query("SELECT * FROM templates LIMIT 5"); // Nhớ tạo bảng templates nhé
        // $templates = $stmt->fetchAll();

        view('client.template', [
            'title' => 'Kho giao diện',
            // 'templates' => $templates
        ]);
    }

    public function detail($slug) {
        view('client.template-detail', [
            'title' => 'Chi tiết giao diện',
            'slug' => $slug
        ]);
    }
}