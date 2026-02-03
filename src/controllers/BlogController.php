<?php
// src/controllers/BlogController.php

require_once __DIR__ . '/../models/Database.php';

class BlogController {
    
    // Trang danh sách tin tức
    public function index() {
        // [SEO] Cấu hình cho trang danh sách
        $seoData = [
            'title' => 'Tin tức & Kiến thức Website',
            'meta_title' => 'Tin tức công nghệ, Kiến thức thiết kế Web & SEO - HolaGroup',
            'meta_desc' => 'Cập nhật xu hướng thiết kế website mới nhất 2026. Chia sẻ kiến thức SEO, Marketing Online và kinh nghiệm kinh doanh hiệu quả.',
            'meta_keywords' => 'kiến thức seo, xu hướng web 2026, marketing online',
            'og_image' => 'https://yourdomain.com/assets/images/blog-cover.jpg'
        ];

        view('client.blog', $seoData); // Truyền dữ liệu sang view
    }

    // Trang chi tiết bài viết (QUAN TRỌNG)
    public function detail($slug) {
        // 1. Giả lập lấy bài viết từ DB theo $slug
        // Thực tế: $post = $this->blogModel->getBySlug($slug);
        $post = [
            'title' => '5 Xu hướng Thiết kế Website sẽ thống trị năm 2026',
            'summary' => 'Năm 2026 đánh dấu sự lên ngôi của Glassmorphism, AI Design và trải nghiệm 3D tương tác. Cùng HolaGroup khám phá ngay!',
            'content' => 'Nội dung chi tiết bài viết ở đây...',
            'image' => 'https://images.unsplash.com/photo-1614728263952-84ea256f9679?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
            'author' => 'Tuấn Anh',
            'created_at' => '2026-02-02',
            'updated_at' => '2026-02-05'
        ];

        // 2. Tạo Schema JSON-LD (Dạng BlogPosting)
        // Giúp Google hiển thị: Ảnh thumbnail + Tên bài + Ngày đăng + Tác giả trên kết quả tìm kiếm
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $post['title'],
            "image" => [
                $post['image']
            ],
            "datePublished" => $post['created_at'],
            "dateModified" => $post['updated_at'],
            "author" => [
                "@type" => "Person",
                "name" => $post['author']
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "HolaGroup",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "http://yourdomain.com/assets/logo.png"
                ]
            ],
            "description" => $post['summary']
        ];

        // 3. Chuẩn bị dữ liệu SEO đầy đủ
        $data = [
            // Dữ liệu nội dung
            'post' => $post,
            'slug' => $slug,

            // Dữ liệu SEO Header
            'meta_title' => $post['title'] . ' - Tin tức HolaGroup', // Title chuẩn SEO: Tên bài - Tên Brand
            'meta_desc' => $post['summary'], // Description lấy từ summary
            'meta_keywords' => 'xu hướng web, thiết kế web 2026, holagroup',
            'meta_author' => $post['author'],
            
            // Canonical: Trỏ về link hiện tại (quan trọng để tránh trùng lặp)
            'meta_canonical' => "http://" . $_SERVER['HTTP_HOST'] . "/tin-tuc/" . $slug,

            // Social Share (Facebook/Zalo)
            'og_type' => 'article',
            'og_image' => $post['image'], // Khi share sẽ hiện ảnh bài viết, không phải logo cty

            // Schema JSON-LD
            'schema_json' => json_encode($schema)
        ];

        view('client.blog-detail', $data);
    }
}