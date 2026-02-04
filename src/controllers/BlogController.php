<?php
// src/controllers/BlogController.php

require_once __DIR__ . '/../models/BlogPost.php';
require_once __DIR__ . '/../models/BlogCategory.php';

class BlogController {
    private $blogModel;
    private $categoryModel;

    public function __construct() {
        $this->blogModel = new BlogPostModel();
        $this->categoryModel = new BlogCategoryModel();
    }

    // Trang danh sách Blog
    public function index() {
        $catSlug = $_GET['cat'] ?? 'all';
        $keyword = $_GET['q'] ?? null;
        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit   = 6; // 6 bài mỗi trang

        // 1. Lấy bài Featured (Chỉ lấy ở trang 1 và khi không search/lọc)
        $featured_post = null;
        if ($page === 1 && $catSlug === 'all' && empty($keyword)) {
            $featured_post = $this->blogModel->getFeaturedPost();
        }

        // 2. Tính phân trang
        $totalRecords = $this->blogModel->countAll($catSlug, $keyword);
        $totalPages   = ceil($totalRecords / $limit);
        if ($page < 1) $page = 1;
        if ($page > $totalPages && $totalPages > 0) $page = $totalPages;
        $offset = ($page - 1) * $limit;

        // 3. Lấy danh sách bài viết
        // Nếu có bài featured thì loại nó ra khỏi danh sách list
        $excludeId = ($featured_post) ? $featured_post['id'] : null;
        $posts = $this->blogModel->getAll($limit, $offset, $catSlug, $keyword, $excludeId);

        // 4. Lấy danh mục cho Sidebar/Menu
        $categories = $this->categoryModel->getAll();

        // 5. SEO & View Data
        $data = [
            'title' => 'Blog Công Nghệ & Marketing',
            'meta_title' => 'Blog Kiến thức Web, SEO, Marketing - HolaGroup',
            'meta_desc' => 'Chia sẻ kiến thức thiết kế web, lập trình, SEO và Marketing Online thực chiến.',
            'featured_post' => $featured_post,
            'posts' => $posts,
            'categories' => $categories,
            'active_cat' => $catSlug,
            'keyword' => $keyword,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_records' => $totalRecords
            ]
        ];

        view('client.blog', $data); // Lưu ý: Tên file view của bạn là blog.php
    }

    // Trang chi tiết bài viết
    public function detail($slug) {
        $post = $this->blogModel->getBySlug($slug);

        if (!$post) {
            header("HTTP/1.0 404 Not Found");
            echo "Bài viết không tồn tại";
            return;
        }

        // Lấy bài liên quan
        $related_posts = $this->blogModel->getRelated($post['category_id'], $post['id'], 3);

        // Format ngày tháng đẹp (VD: 04 Tháng 02, 2026)
        $date = date_create($post['published_at']);
        $post['date_text'] = date_format($date, "d/m/Y");

        // Schema Article
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $post['title'],
            "image" => $post['thumbnail'],
            "author" => [
                "@type" => "Person",
                "name" => $post['author_name']
            ],
            "datePublished" => $post['published_at'],
            "description" => $post['summary']
        ];

        $data = [
            'post' => $post,
            'related_posts' => $related_posts,
            'title' => $post['title'],
            'meta_title' => $post['title'] . ' - Blog HolaGroup',
            'meta_desc' => $post['summary'],
            'og_image' => $post['thumbnail'],
            'schema_json' => json_encode($schema)
        ];

        view('client.blog-detail', $data);
    }
}