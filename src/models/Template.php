<?php
// src/models/Template.php
require_once __DIR__ . '/Database.php';

class TemplateModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Hàm lấy danh sách
    public function getAll($limit = 12, $offset = 0, $catSlug = null, $keyword = null) {
        $sql = "SELECT t.*, c.name as cat_name, c.slug as cat_slug 
                FROM templates t 
                JOIN template_categories c ON t.category_id = c.id 
                WHERE t.status = 1";
        
        $params = [];

        if ($catSlug && $catSlug !== 'all') {
            $sql .= " AND c.slug = :cat_slug";
            $params[':cat_slug'] = $catSlug;
        }

        if ($keyword) {
            $sql .= " AND t.name LIKE :keyword";
            $params[':keyword'] = "%$keyword%";
        }

        $sql .= " ORDER BY t.created_at DESC LIMIT " . (int)$limit . " OFFSET " . (int)$offset;

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Hàm đếm tổng
    public function countAll($catSlug = null, $keyword = null) {
        $sql = "SELECT COUNT(*) as total 
                FROM templates t 
                JOIN template_categories c ON t.category_id = c.id 
                WHERE t.status = 1";
        
        $params = [];

        if ($catSlug && $catSlug !== 'all') {
            $sql .= " AND c.slug = :cat_slug";
            $params[':cat_slug'] = $catSlug;
        }

        if ($keyword) {
            $sql .= " AND t.name LIKE :keyword";
            $params[':keyword'] = "%$keyword%";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result['total'];
    }

    // [QUAN TRỌNG] Hàm lấy chi tiết - ĐÃ SỬA LỖI
    public function getBySlug($slug) {
        // 1. Lấy thông tin cơ bản
        $sql = "SELECT t.*, c.name as cat_name 
                FROM templates t 
                JOIN template_categories c ON t.category_id = c.id 
                WHERE t.slug = :slug AND t.status = 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $template = $stmt->fetch();

        if (!$template) return null;

        // 2. Lấy danh sách ảnh Gallery (Bỏ cột 'type' vì bảng này không có)
        $sqlImg = "SELECT image_url FROM template_images WHERE template_id = :id ORDER BY sort_order ASC";
        $stmtImg = $this->conn->prepare($sqlImg);
        $stmtImg->execute([':id' => $template['id']]);
        $galleryRaw = $stmtImg->fetchAll();

        // 3. Cấu trúc lại mảng images chuẩn cho View
        // Ảnh chính lấy từ bảng templates, Gallery lấy từ bảng template_images
        $template['images'] = [
            'main'    => !empty($template['image_desktop']) ? $template['image_desktop'] : '/assets/images/no-image.jpg',
            'sub2'    => !empty($template['image_mobile']) ? $template['image_mobile'] : '/assets/images/no-image.jpg', // Dùng cho Mobile Demo
            'gallery' => []
        ];

        // Đổ dữ liệu gallery vào
        foreach ($galleryRaw as $img) {
            $template['images']['gallery'][] = $img['image_url'];
        }

        // 4. Lấy tính năng
        $sqlFeat = "SELECT feature_text FROM template_features WHERE template_id = :id ORDER BY sort_order ASC";
        $stmtFeat = $this->conn->prepare($sqlFeat);
        $stmtFeat->execute([':id' => $template['id']]);
        $template['features'] = $stmtFeat->fetchAll(PDO::FETCH_COLUMN);

        // 5. Lấy công nghệ
        $sqlTech = "SELECT tech.name 
                    FROM template_techs tech
                    JOIN template_tech_map map ON tech.id = map.tech_id
                    WHERE map.template_id = :id";
        $stmtTech = $this->conn->prepare($sqlTech);
        $stmtTech->execute([':id' => $template['id']]);
        $template['tech_specs'] = $stmtTech->fetchAll(PDO::FETCH_COLUMN);

        return $template;
    }

    // Lấy các giao diện liên quan
    public function getRelated($categoryId, $currentId, $limit = 4) {
        $sql = "SELECT t.*, c.name as cat_name 
                FROM templates t 
                JOIN template_categories c ON t.category_id = c.id 
                WHERE t.category_id = :cat_id AND t.id != :id AND t.status = 1 
                ORDER BY RAND() LIMIT " . (int)$limit;
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cat_id' => $categoryId, ':id' => $currentId]);
        return $stmt->fetchAll();
    }

    // Hàm tăng lượt xem cho Giao diện
    public function increaseView($id) {
        $sql = "UPDATE templates SET views = views + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}