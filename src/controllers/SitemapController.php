<?php

class SitemapController {
    
    public function index() {
        // Xóa buffer output để tránh lỗi
        if (ob_get_length()) ob_clean();
        
        // Thiết lập header XML
        header('Content-Type: application/xml; charset=utf-8');
        header('Cache-Control: public, max-age=3600');
        
        // Lấy base URL từ Config (đã xử lý env và auto-detect chuẩn)
        require_once __DIR__ . '/../config.php';
        $baseUrl = Config::getBaseUrl();
        
        // Tạo XML string thay vì echo trực tiếp
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Trang chủ
        $xml .= $this->generateUrlNode($baseUrl, date('Y-m-d'), '1.0', 'daily');
        
        // Các trang tĩnh
        $staticPages = [
            '/gioi-thieu' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/dich-vu' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/chinh-sach' => ['priority' => '0.5', 'changefreq' => 'monthly'],
            '/lien-he' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/tin-tuc' => ['priority' => '0.9', 'changefreq' => 'daily'],
            '/kho-giao-dien' => ['priority' => '0.9', 'changefreq' => 'daily']
        ];
        
        foreach ($staticPages as $path => $config) {
            $xml .= $this->generateUrlNode($baseUrl . $path, date('Y-m-d'), $config['priority'], $config['changefreq']);
        }
        
        // Thêm các trang blog từ database
        try {
            $blogs = $this->getBlogPosts();
            foreach ($blogs as $blog) {
                $url = $baseUrl . '/tin-tuc/' . $blog['slug'];
                $lastmod = !empty($blog['updated_at']) ? $blog['updated_at'] : $blog['created_at'];
                $xml .= $this->generateUrlNode($url, date('Y-m-d', strtotime($lastmod)), '0.8', 'weekly');
            }
        } catch (Exception $e) {
            // Log error nhưng không break sitemap
            error_log('Sitemap blog error: ' . $e->getMessage());
        }
        
        // Thêm các trang template từ database
        try {
            $templates = $this->getTemplates();
            foreach ($templates as $template) {
                $url = $baseUrl . '/kho-giao-dien/' . $template['slug'];
                $lastmod = !empty($template['updated_at']) ? $template['updated_at'] : $template['created_at'];
                $xml .= $this->generateUrlNode($url, date('Y-m-d', strtotime($lastmod)), '0.8', 'weekly');
            }
        } catch (Exception $e) {
            // Log error nhưng không break sitemap
            error_log('Sitemap template error: ' . $e->getMessage());
        }
        
        $xml .= '</urlset>';
        
        // Output XML với độ dài đúng
        header('Content-Length: ' . strlen($xml));
        echo $xml;
        exit;
    }
    
    private function outputUrlNode($url, $lastmod, $priority, $changefreq) {
        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
        echo "    <lastmod>" . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8') . "</lastmod>\n";
        echo "    <priority>" . htmlspecialchars($priority, ENT_XML1, 'UTF-8') . "</priority>\n";
        echo "    <changefreq>" . htmlspecialchars($changefreq, ENT_XML1, 'UTF-8') . "</changefreq>\n";
        echo "  </url>\n";
    }
    
    private function generateUrlNode($url, $lastmod, $priority, $changefreq) {
        $node = "  <url>\n";
        $node .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
        $node .= "    <lastmod>" . htmlspecialchars($lastmod, ENT_XML1, 'UTF-8') . "</lastmod>\n";
        $node .= "    <priority>" . htmlspecialchars($priority, ENT_XML1, 'UTF-8') . "</priority>\n";
        $node .= "    <changefreq>" . htmlspecialchars($changefreq, ENT_XML1, 'UTF-8') . "</changefreq>\n";
        $node .= "  </url>\n";
        return $node;
    }
    
    private function getBlogPosts() {
        // Lấy danh sách blog từ database
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT slug, created_at, published_at FROM blog_posts WHERE status = 1 ORDER BY created_at DESC");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Map published_at to updated_at for consistency
        foreach ($posts as &$post) {
            $post['updated_at'] = $post['published_at'] ?? $post['created_at'];
        }
        
        return $posts;
    }
    
    private function getTemplates() {
        // Lấy danh sách template từ database
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT slug, created_at FROM templates WHERE status = 1 ORDER BY created_at DESC");
        $stmt->execute();
        $templates = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Map created_at to updated_at for consistency
        foreach ($templates as &$template) {
            $template['updated_at'] = $template['created_at'];
        }
        
        return $templates;
    }
}
