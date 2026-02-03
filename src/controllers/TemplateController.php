<?php
// src/controllers/TemplateController.php

require_once __DIR__ . '/../models/Database.php';

class TemplateController {
    
    // Trang danh sách giao diện
    public function index() {
        $seoData = [
            'title' => 'Kho Giao Diện Website Đẹp',
            'meta_title' => 'Kho 500+ Mẫu Website Đẹp, Chuẩn SEO, Giá Rẻ - HolaGroup',
            'meta_desc' => 'Tổng hợp các mẫu giao diện website bán hàng, bất động sản, doanh nghiệp đẹp nhất 2026. Tối ưu tốc độ, chuẩn mobile, bảo hành trọn đời.',
            'og_image' => 'https://yourdomain.com/assets/images/template-store-cover.jpg'
        ];
        
        view('client.template', $seoData);
    }

    // Trang chi tiết giao diện (QUAN TRỌNG)
    public function detail($slug) {
        // 1. Giả lập dữ liệu Template
        $template = [
            'id' => 1,
            'name' => 'TechZone - Siêu thị điện máy',
            'price' => 2500000, // Giá số nguyên để dùng cho Schema
            'price_text' => '2.500.000đ', // Giá hiển thị
            'category' => 'Bán hàng',
            'desc' => 'Giao diện web bán hàng điện máy chuẩn SEO, tích hợp bộ lọc thông minh, thanh toán online.',
            'images' => [
                'main' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
            ]
        ];

        // 2. Tạo Schema JSON-LD (Dạng Product)
        // Giúp Google hiển thị: Giá tiền + Trạng thái còn hàng (Rich Snippets)
        $schema = [
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => $template['name'],
            "image" => [
                $template['images']['main']
            ],
            "description" => $template['desc'],
            "brand" => [
                "@type" => "Brand",
                "name" => "HolaGroup"
            ],
            "offers" => [
                "@type" => "Offer",
                "url" => "http://" . $_SERVER['HTTP_HOST'] . "/templates/" . $slug,
                "priceCurrency" => "VND",
                "price" => $template['price'],
                "availability" => "https://schema.org/InStock", // Trạng thái còn hàng
                "itemCondition" => "https://schema.org/NewCondition"
            ]
        ];

        // 3. Chuẩn bị dữ liệu SEO
        $data = [
            'template' => $template,
            'slug' => $slug,

            // SEO Tags
            'meta_title' => 'Mẫu web ' . $template['name'] . ' - Giá Rẻ | HolaGroup',
            'meta_desc' => "Mua mẫu website " . $template['name'] . " chỉ với " . $template['price_text'] . ". " . $template['desc'],
            'meta_keywords' => 'web điện máy, mẫu web bán hàng, giao diện techzone',
            
            'meta_canonical' => "http://" . $_SERVER['HTTP_HOST'] . "/templates/" . $slug,

            // Social Share
            'og_type' => 'product', // Facebook hiểu đây là sản phẩm
            'og_image' => $template['images']['main'],

            // Schema
            'schema_json' => json_encode($schema)
        ];

        view('client.template-detail', $data);
    }
}