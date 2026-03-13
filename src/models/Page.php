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
        } else {
            // --- FALLBACK MODE ---
            // Nếu không tìm thấy trong DB (do chưa import hoặc lỡ xóa),
            // sẽ load từ file JSON dự phòng để web không bị lỗi.
            $fallbackFile = __DIR__ . '/../data/pages_fallback.json';
            
            if (file_exists($fallbackFile)) {
                $jsonContent = file_get_contents($fallbackFile);
                $fallbackData = json_decode($jsonContent, true);

                if (is_array($fallbackData) && isset($fallbackData[$slug])) {
                    $item = $fallbackData[$slug];
                    // Giả lập cấu trúc dữ liệu giống DB trả về
                    $page = [
                        'id' => 0,
                        'slug' => $slug,
                        'name' => $item['name'] ?? 'Untitled',
                        'meta_title' => $item['meta_title'] ?? '',
                        'meta_desc' => $item['meta_desc'] ?? '',
                        'meta_image' => '',
                        'updated_at' => date('Y-m-d H:i:s'),
                        'content' => $item['content'] ?? [] // Đã là array, không cần decode nữa
                    ];
                }
            }
        }

        return $page;
    }
}