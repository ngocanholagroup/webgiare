<?php
// src/models/Template.php
require_once __DIR__ . '/Database.php';

class TemplateModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Hàm lấy danh sách (Đã sửa JOIN template_categories)
    public function getAll($limit = 12, $offset = 0, $catSlug = null, $keyword = null) {
        // SỬA: JOIN template_categories
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

    // Hàm đếm tổng (Đã sửa JOIN template_categories)
    public function countAll($catSlug = null, $keyword = null) {
        // SỬA: JOIN template_categories
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

    // Hàm lấy chi tiết (Đã sửa JOIN template_categories và các bảng phụ)
    public function getBySlug($slug) {
        // 1. Lấy thông tin cơ bản
        // SỬA: JOIN template_categories (Đây là chỗ gây lỗi 1146)
        $sql = "SELECT t.*, c.name as cat_name 
                FROM templates t 
                JOIN template_categories c ON t.category_id = c.id 
                WHERE t.slug = :slug AND t.status = 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':slug' => $slug]);
        $template = $stmt->fetch();

        if (!$template) return null;

        // 2. Lấy danh sách ảnh (Giữ nguyên vì tên bảng template_images không đổi)
        $sqlImg = "SELECT type, image_url FROM template_images WHERE template_id = :id ORDER BY sort_order ASC";
        $stmtImg = $this->conn->prepare($sqlImg);
        $stmtImg->execute([':id' => $template['id']]);
        $imagesRaw = $stmtImg->fetchAll();

        // Format lại mảng ảnh
        $template['images'] = ['gallery' => []];
        foreach ($imagesRaw as $img) {
            if ($img['type'] === 'main') $template['images']['main'] = $img['image_url'];
            elseif ($img['type'] === 'mobile_demo') $template['images']['sub2'] = $img['image_url'];
            else $template['images']['gallery'][] = $img['image_url'];
        }
        if (!isset($template['images']['main'])) $template['images']['main'] = '/assets/images/no-image.jpg';

        // 3. Lấy tính năng (Giữ nguyên)
        $sqlFeat = "SELECT feature_text FROM template_features WHERE template_id = :id ORDER BY sort_order ASC";
        $stmtFeat = $this->conn->prepare($sqlFeat);
        $stmtFeat->execute([':id' => $template['id']]);
        $template['features'] = $stmtFeat->fetchAll(PDO::FETCH_COLUMN);

        // 4. Lấy công nghệ
        // SỬA: JOIN template_techs và template_tech_map (Tên bảng mới)
        $sqlTech = "SELECT tech.name 
                    FROM template_techs tech
                    JOIN template_tech_map map ON tech.id = map.tech_id
                    WHERE map.template_id = :id";
        $stmtTech = $this->conn->prepare($sqlTech);
        $stmtTech->execute([':id' => $template['id']]);
        $template['tech_specs'] = $stmtTech->fetchAll(PDO::FETCH_COLUMN);

        return $template;
    }

    // Lấy các giao diện liên quan (Cùng danh mục, trừ ID hiện tại)
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
}