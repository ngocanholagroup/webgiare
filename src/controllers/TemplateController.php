<?php
// src/controllers/TemplateController.php
require_once __DIR__ . '/../models/Template.php';
require_once __DIR__ . '/../models/TemplateCategory.php';

class TemplateController {
    private $templateModel;
    private $categoryModel;

    public function __construct() {
        $this->templateModel = new TemplateModel();
        $this->categoryModel = new TemplateCategoryModel();
    }

    public function index() {
        // 1. Nhận tham số từ URL
        $catSlug = $_GET['cat'] ?? 'all';
        $keyword = $_GET['q'] ?? null;
        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit   = 9; // Số lượng template trên 1 trang (9 cái cho đẹp grid 3x3)

        // 2. Tính toán phân trang
        $totalRecords = $this->templateModel->countAll($catSlug, $keyword);
        $totalPages   = ceil($totalRecords / $limit);
        
        // Đảm bảo page hợp lệ
        if ($page < 1) $page = 1;
        if ($page > $totalPages && $totalPages > 0) $page = $totalPages;

        $offset = ($page - 1) * $limit;

        // 3. Lấy dữ liệu
        $templates = $this->templateModel->getAll($limit, $offset, $catSlug, $keyword);
        $categories = $this->categoryModel->getAll();

        // 4. Xử lý SEO Title
        $pageTitle = 'Kho Giao Diện Website';
        if ($catSlug !== 'all') {
            $catInfo = $this->categoryModel->getBySlug($catSlug);
            if ($catInfo) $pageTitle = 'Mẫu Website ' . $catInfo['name'];
        }
        if ($keyword) {
            $pageTitle .= ' - Tìm kiếm: ' . $keyword;
        }

        // 5. Truyền dữ liệu sang View
        $data = [
            'title' => $pageTitle,
            'templates' => $templates,
            'categories' => $categories,
            'active_cat' => $catSlug,
            'keyword' => $keyword,
            
            // Dữ liệu phân trang
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_records' => $totalRecords
            ]
        ];
        
        view('client.template', $data);
    }

    public function detail($slug) {
        $template = $this->templateModel->getBySlug($slug);

        if (!$template) {
            // Xử lý 404 tốt hơn: load view 404
            echo "404 - Không tìm thấy giao diện";
            return;
        }

        // Format giá
        $price_val = $template['sale_price'] > 0 ? $template['sale_price'] : $template['price'];
        $template['price_text'] = number_format($price_val, 0, ',', '.') . 'đ';
        $template['old_price_text'] = ($template['sale_price'] > 0) ? number_format($template['price'], 0, ',', '.') . 'đ' : null;

        // --- MỚI: Lấy 4 giao diện liên quan ---
        $related_templates = $this->templateModel->getRelated($template['category_id'], $template['id'], 4);

        // Schema JSON-LD
        $schema = [
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => $template['name'],
            "sku" => $template['sku'],
            "image" => [$template['images']['main']],
            "description" => strip_tags($template['description']),
            "brand" => ["@type" => "Brand", "name" => "HolaGroup"],
            "offers" => [
                "@type" => "Offer",
                "url" => "http://" . $_SERVER['HTTP_HOST'] . "/kho-giao-dien/" . $slug,
                "priceCurrency" => "VND",
                "price" => $price_val,
                "availability" => "https://schema.org/InStock",
                "itemCondition" => "https://schema.org/NewCondition"
            ]
        ];

        $data = [
            'template' => $template,
            'related_templates' => $related_templates, // <--- Truyền biến này sang View
            
            // SEO
            'title' => $template['name'] . ' - Mẫu Web Đẹp',
            'meta_title' => $template['name'] . ' - Giá Rẻ | HolaGroup',
            'meta_desc' => substr(strip_tags($template['description']), 0, 160),
            'meta_canonical' => "http://" . $_SERVER['HTTP_HOST'] . "/kho-giao-dien/" . $slug,
            'og_type' => 'product',
            'og_image' => $template['images']['main'],
            'schema_json' => json_encode($schema)
        ];

        view('client.template-detail', $data);
    }
}