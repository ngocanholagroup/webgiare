<?php
// src/models/BlogPost.php
require_once __DIR__ . '/Database.php';

class BlogPostModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // 1. Lấy 1 bài viết nổi bật nhất (Featured Post)
    public function getFeaturedPost() {
        $sql = "SELECT p.*, c.name as cat_name, c.slug as cat_slug, a.name as author_name 
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                JOIN blog_authors a ON p.author_id = a.id
                WHERE p.is_featured = 1 AND p.status = 1
                ORDER BY p.published_at DESC 
                LIMIT 1";
        
        $stmt = $this->conn->query($sql);
        return $stmt->fetch();
    }

    // 2. Lấy danh sách bài viết (Có Lọc + Tìm kiếm + Phân trang)
    public function getAll($limit = 6, $offset = 0, $catSlug = null, $keyword = null, $excludeId = null) {
        $sql = "SELECT p.*, c.name as cat_name, c.slug as cat_slug 
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 1";
        
        $params = [];

        // Nếu có ID cần loại trừ (ví dụ bài Featured đã hiện ở trên rồi thì dưới không hiện nữa)
        if ($excludeId) {
            $sql .= " AND p.id != :exclude_id";
            $params[':exclude_id'] = $excludeId;
        }

        // Lọc theo danh mục
        if ($catSlug && $catSlug !== 'all') {
            $sql .= " AND c.slug = :cat_slug";
            $params[':cat_slug'] = $catSlug;
        }

        // Tìm kiếm
        if ($keyword) {
            $sql .= " AND p.title LIKE :keyword";
            $params[':keyword'] = "%$keyword%";
        }

        $sql .= " ORDER BY p.published_at DESC LIMIT " . (int)$limit . " OFFSET " . (int)$offset;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // 3. Đếm tổng số bài (Để phân trang)
    public function countAll($catSlug = null, $keyword = null) {
        $sql = "SELECT COUNT(*) as total 
                FROM blog_posts p 
                JOIN blog_categories c ON p.category_id = c.id 
                WHERE p.status = 1";
        $params = [];

        if ($catSlug && $catSlug !== 'all') {
            $sql .= " AND c.slug = :cat_slug";
            $params[':cat_slug'] = $catSlug;
        }
        if ($keyword) {
            $sql .= " AND p.title LIKE :keyword";
            $params[':keyword'] = "%$keyword%";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result['total'];
    }

    // 4. Lấy chi tiết bài viết (Kèm thông tin Tác giả đầy đủ)
    public function getBySlug($slug) {
        $sql = "SELECT p.*, c.name as cat_name, c.slug as cat_slug,
                       a.name as author_name, a.avatar as author_avatar, a.bio as author_bio, a.title as author_title
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                JOIN blog_authors a ON p.author_id = a.id
                WHERE p.slug = :slug AND p.status = 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $post = $stmt->fetch();

        if ($post) {
            // Tăng lượt xem lên 1
            $this->incrementViews($post['id']);
            
            // Lấy thêm Tags của bài viết này
            $post['tags'] = $this->getTagsByPost($post['id']);
        }

        return $post;
    }

    // 5. Lấy Tags của 1 bài viết
    private function getTagsByPost($postId) {
        $sql = "SELECT t.* FROM blog_tags t 
                JOIN blog_post_tags pt ON t.id = pt.tag_id 
                WHERE pt.post_id = :pid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':pid' => $postId]);
        return $stmt->fetchAll();
    }

    // 6. Lấy bài viết liên quan (Cùng danh mục)
    public function getRelated($catId, $currentId, $limit = 3) {
        $sql = "SELECT p.*, c.name as cat_name 
                FROM blog_posts p 
                JOIN blog_categories c ON p.category_id = c.id
                WHERE p.category_id = :cid AND p.id != :id AND p.status = 1
                ORDER BY RAND() LIMIT " . (int)$limit;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cid' => $catId, ':id' => $currentId]);
        return $stmt->fetchAll();
    }

    // 7. Tăng view
    private function incrementViews($id) {
        $stmt = $this->conn->prepare("UPDATE blog_posts SET views = views + 1 WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}