<?php
// src/models/AdminTemplate.php

class AdminTemplate
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    // 1. [MỚI] Hàm getById (Bổ sung để sửa lỗi thiếu hàm)
    public function getById($id)
    {
        $sql = "SELECT * FROM templates WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function countAll($search = '')
    {
        $sql = "SELECT COUNT(*) as total FROM templates WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (name LIKE :s1 OR sku LIKE :s2)";
            $params[':s1'] = "%$search%";
            $params[':s2'] = "%$search%";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function getAll($limit, $offset, $search = '')
    {
        $sql = "SELECT t.*, c.name as category_name 
                FROM templates t 
                LEFT JOIN template_categories c ON t.category_id = c.id 
                WHERE 1=1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND (t.name LIKE :s1 OR t.sku LIKE :s2)";
            $params[':s1'] = "%$search%";
            $params[':s2'] = "%$search%";
        }

        $sql .= " ORDER BY t.created_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBySlug($slug)
    {
        $sql = "SELECT * FROM templates WHERE slug = :slug LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getLastId() {
        return $this->conn->lastInsertId();
    }

    public function getCategories()
    {
        $stmt = $this->conn->prepare("SELECT id, name FROM template_categories ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Hàm lấy danh mục kèm thống kê số lượng (dùng cho tab Danh mục)
    public function getCategoriesWithStats()
    {
        $sql = "SELECT c.*, COUNT(t.id) as total_templates 
            FROM template_categories c 
            LEFT JOIN templates t ON c.id = t.category_id 
            GROUP BY c.id 
            ORDER BY c.name ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // [CẬP NHẬT] Đổi thumbnail thành image_desktop & image_mobile
    public function create($data)
    {
        $sql = "INSERT INTO templates (category_id, name, slug, sku, description, price, sale_price, image_desktop, image_mobile, demo_url, score_desktop, score_mobile, status) 
                VALUES (:category_id, :name, :slug, :sku, :description, :price, :sale_price, :image_desktop, :image_mobile, :demo_url, :score_desktop, :score_mobile, :status)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':category_id' => $data['category_id'],
            ':name'        => $data['name'],
            ':slug'        => $data['slug'],
            ':sku'         => $data['sku'],
            ':description' => $data['description'],
            ':price'       => $data['price'],
            ':sale_price'  => $data['sale_price'],
            ':image_desktop' => $data['image_desktop'], // Mới
            ':image_mobile'  => $data['image_mobile'],  // Mới
            ':demo_url'    => $data['demo_url'],
            ':score_desktop' => $data['score_desktop'],
            ':score_mobile' => $data['score_mobile'],
            ':status'      => $data['status']
        ]);
    }

    // [CẬP NHẬT] Đổi thumbnail thành image_desktop & image_mobile
    public function update($id, $data)
    {
        $sql = "UPDATE templates SET 
                category_id = :category_id,
                name = :name,
                slug = :slug,
                sku = :sku,
                description = :description,
                price = :price,
                sale_price = :sale_price,
                image_desktop = :image_desktop,
                image_mobile = :image_mobile,
                demo_url = :demo_url,
                score_desktop = :score_desktop,
                score_mobile = :score_mobile,
                status = :status
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id'          => $id,
            ':category_id' => $data['category_id'],
            ':name'        => $data['name'],
            ':slug'        => $data['slug'],
            ':sku'         => $data['sku'],
            ':description' => $data['description'],
            ':price'       => $data['price'],
            ':sale_price'  => $data['sale_price'],
            ':image_desktop' => $data['image_desktop'], // Mới
            ':image_mobile'  => $data['image_mobile'],  // Mới
            ':demo_url'    => $data['demo_url'],
            ':score_desktop' => $data['score_desktop'],
            ':score_mobile' => $data['score_mobile'],
            ':status'      => $data['status']
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM templates WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // --- GALLERY SECTION ---

    public function getGallery($template_id) {
        $stmt = $this->conn->prepare("SELECT * FROM template_images WHERE template_id = :id ORDER BY sort_order ASC, id DESC");
        $stmt->execute([':id' => $template_id]);
        return $stmt->fetchAll();
    }

    public function addGalleryImage($template_id, $url) {
        $stmt = $this->conn->prepare("INSERT INTO template_images (template_id, image_url) VALUES (:tid, :url)");
        return $stmt->execute([':tid' => $template_id, ':url' => $url]);
    }

    public function getGalleryImageById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM template_images WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function deleteGalleryImage($id) {
        $stmt = $this->conn->prepare("DELETE FROM template_images WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}