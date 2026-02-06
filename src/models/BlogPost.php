<?php
require_once __DIR__ . '/Database.php';

class BlogPostModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // 1. Lấy bài viết nổi bật (Featured) mới nhất
    public function getFeaturedPost() {
        $sql = "SELECT p.*, 
                       c.name as category_name, c.slug as category_slug,
                       a.name as author_name, a.avatar as author_avatar
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                JOIN blog_authors a ON p.author_id = a.id
                WHERE p.status = 1 AND p.is_featured = 1
                ORDER BY p.published_at DESC 
                LIMIT 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // 2. Lấy danh sách bài viết (Có lọc, tìm kiếm, phân trang)
    public function getAll($limit, $offset, $catSlug = 'all', $keyword = null, $excludeId = null) {
        $sql = "SELECT p.*, 
                       c.name as category_name, c.slug as category_slug,
                       a.name as author_name, a.avatar as author_avatar
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                JOIN blog_authors a ON p.author_id = a.id
                WHERE p.status = 1";
        
        $params = [];

        // Lọc theo danh mục
        if ($catSlug !== 'all') {
            $sql .= " AND c.slug = :catSlug";
            $params[':catSlug'] = $catSlug;
        }

        // Tìm kiếm từ khóa
        if (!empty($keyword)) {
            $sql .= " AND p.title LIKE :keyword";
            $params[':keyword'] = "%$keyword%";
        }

        // Loại trừ bài viết (thường là bài Featured để không lặp lại)
        if (!empty($excludeId)) {
            $sql .= " AND p.id != :excludeId";
            $params[':excludeId'] = $excludeId;
        }

        $sql .= " ORDER BY p.published_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        
        // Bind params
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. Đếm tổng số bài (để phân trang)
    public function countAll($catSlug = 'all', $keyword = null) {
        $sql = "SELECT COUNT(*) as total 
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                WHERE p.status = 1";
        
        $params = [];

        if ($catSlug !== 'all') {
            $sql .= " AND c.slug = :catSlug";
            $params[':catSlug'] = $catSlug;
        }

        if (!empty($keyword)) {
            $sql .= " AND p.title LIKE :keyword";
            $params[':keyword'] = "%$keyword%";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch()['total'];
    }

    // 4. Lấy chi tiết bài viết theo Slug
    public function getBySlug($slug) {
        $sql = "SELECT p.*, 
                       c.name as category_name, c.slug as category_slug,
                       a.name as author_name, a.avatar as author_avatar, a.bio as author_bio
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                JOIN blog_authors a ON p.author_id = a.id
                WHERE p.slug = :slug AND p.status = 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }

    // 5. Tăng lượt xem
    public function increaseView($id) {
        $stmt = $this->conn->prepare("UPDATE blog_posts SET views = views + 1 WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // 6. Lấy bài viết liên quan (Cùng danh mục)
    public function getRelated($categoryId, $currentId, $limit = 3) {
        $sql = "SELECT p.*, c.name as category_name, c.slug as category_slug
                FROM blog_posts p
                JOIN blog_categories c ON p.category_id = c.id
                WHERE p.category_id = :catId 
                  AND p.id != :currentId 
                  AND p.status = 1
                ORDER BY RAND() 
                LIMIT :limit"; // Random để bài liên quan thay đổi cho phong phú
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':catId', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':currentId', $currentId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
}