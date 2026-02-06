-- --------------------------------------------------------
-- PHẦN 1: CHỌN DATABASE VÀ RESET DỮ LIỆU CŨ
-- --------------------------------------------------------

-- Chọn database (Đảm bảo bạn đã tạo database này trước)
-- CREATE DATABASE IF NOT EXISTS webgiare_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE webgiare_db;

-- Tắt kiểm tra khóa ngoại để xóa bảng dễ dàng hơn
SET FOREIGN_KEY_CHECKS = 0;

-- Xóa sạch bảng cũ để làm mới dữ liệu
DROP TABLE IF EXISTS `template_features`;
DROP TABLE IF EXISTS `template_tech_map`;
DROP TABLE IF EXISTS `template_techs`;
DROP TABLE IF EXISTS `template_images`;
DROP TABLE IF EXISTS `templates`;
DROP TABLE IF EXISTS `template_categories`;

DROP TABLE IF EXISTS `blog_post_tags`;
DROP TABLE IF EXISTS `blog_tags`;
DROP TABLE IF EXISTS `blog_posts`;
DROP TABLE IF EXISTS `blog_authors`;
DROP TABLE IF EXISTS `blog_categories`;

DROP TABLE IF EXISTS `contacts`;
DROP TABLE IF EXISTS `contact_services`;
DROP TABLE IF EXISTS `system_settings`;
DROP TABLE IF EXISTS `pages`;
DROP TABLE IF EXISTS `admins`;

-- Bật lại kiểm tra khóa ngoại
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------
-- PHẦN 2: TẠO CẤU TRÚC BẢNG (SCHEMA)
-- --------------------------------------------------------

-- 1. DANH MỤC GIAO DIỆN
CREATE TABLE `template_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. SẢN PHẨM / GIAO DIỆN
CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `description` longtext,
  `price` decimal(15,0) NOT NULL DEFAULT '0',
  `sale_price` decimal(15,0) DEFAULT NULL,
  
  -- [FIX] Đã thêm cột thumbnail vào đây để khớp với lệnh INSERT bên dưới
  `thumbnail` varchar(255) DEFAULT NULL, 
  
  `image_desktop` varchar(255) DEFAULT NULL,
  `image_mobile` varchar(255) DEFAULT NULL,
  `demo_url` varchar(255) DEFAULT NULL,
  `score_mobile` int(3) DEFAULT 95,
  `score_desktop` int(3) DEFAULT 100,
  `views` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `sku` (`sku`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk_tpl_cat` FOREIGN KEY (`category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. HÌNH ẢNH CHI TIẾT (GALLERY)
CREATE TABLE `template_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT 'gallery', -- [FIX] Thêm cột type để phân loại ảnh
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  CONSTRAINT `fk_img_tpl` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. CÔNG NGHỆ
CREATE TABLE `template_techs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. MAP TEMPLATE - CÔNG NGHỆ
CREATE TABLE `template_tech_map` (
  `template_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL,
  PRIMARY KEY (`template_id`,`tech_id`),
  CONSTRAINT `fk_map_tpl` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_map_tech` FOREIGN KEY (`tech_id`) REFERENCES `template_techs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. TÍNH NĂNG NỔI BẬT
CREATE TABLE `template_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `feature_text` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  CONSTRAINT `fk_feat_tpl` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. DANH MỤC BLOG
CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. TÁC GIẢ BLOG
CREATE TABLE `blog_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `bio` text,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. BÀI VIẾT BLOG
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `summary` text,
  `content` longtext,
  `thumbnail` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `reading_time` int(3) DEFAULT 5,
  `is_featured` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `published_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `cat_id` (`category_id`),
  KEY `auth_id` (`author_id`),
  CONSTRAINT `fk_blog_cat` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_blog_auth` FOREIGN KEY (`author_id`) REFERENCES `blog_authors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. TAGS
CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 11. MAP BÀI VIẾT - TAGS
CREATE TABLE `blog_post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`, `tag_id`),
  CONSTRAINT `fk_map_post` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_map_tag` FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 12. LIÊN HỆ (CONTACTS)
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `related_template` varchar(50) DEFAULT NULL,
  `message` text,
  `status` enum('new', 'contacted', 'completed', 'spam') DEFAULT 'new',
  `admin_note` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_service` (`service_type`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 13. DỊCH VỤ LIÊN HỆ
CREATE TABLE `contact_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 14. CẤU HÌNH HỆ THỐNG
CREATE TABLE `system_settings` (
  `setting_key` varchar(50) NOT NULL,
  `setting_value` longtext,
  `setting_group` varchar(50) DEFAULT 'general',
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 15. TRANG TĨNH / LANDING (PAGES)
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content_json` JSON DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `meta_image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 16. ADMINS
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT 'Administrator',
  `email` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
-- PHẦN 4: THÊM DỮ LIỆU MẪU (SEED DATA)
-- --------------------------------------------------------

-- 1. TEMPLATE CATEGORIES
INSERT INTO `template_categories` (`id`, `name`, `slug`) VALUES
(1, 'Bán hàng', 'ban-hang'),
(2, 'Bất động sản', 'bds'),
(3, 'Doanh nghiệp', 'doanh-nghiep'),
(4, 'Landing Page', 'landing'),
(5, 'Blog/Tin tức', 'blog');

-- 2. TEMPLATES
-- [FIX] Link ảnh đã được thay bằng Unsplash source & Placehold.co để đảm bảo load được
INSERT INTO `templates` (`id`, `category_id`, `name`, `slug`, `sku`, `description`, `price`, `sale_price`, `thumbnail`, `score_mobile`, `score_desktop`) VALUES
(1, 1, 'TechZone - Siêu thị điện máy', 'techzone-sieu-thi-dien-may', 'THEME-001', 'TechZone là mẫu website bán hàng hiện đại...', 3500000, 2500000, 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=800&auto=format&fit=crop', 98, 100);

-- 3. TEMPLATE IMAGES
INSERT INTO `template_images` (`template_id`, `image_url`, `type`) VALUES
(1, 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1200&auto=format&fit=crop', 'main'),
(1, 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop', 'gallery'),
(1, 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop', 'mobile_demo');

-- 4. TECHS
INSERT INTO `template_techs` (`id`, `name`) VALUES (1, 'HTML5'), (2, 'CSS3'), (3, 'Bootstrap 5'), (4, 'PHP 8');

-- 5. TECH MAP
INSERT INTO `template_tech_map` (`template_id`, `tech_id`) VALUES (1, 1), (1, 2), (1, 3), (1, 4);

-- 6. FEATURES
INSERT INTO `template_features` (`template_id`, `feature_text`) VALUES 
(1, 'Giao diện Mobile-First tối ưu'), 
(1, 'Bộ lọc sản phẩm đa tầng'),
(1, 'Tối ưu SEO On-page');

-- 7. BLOG CATEGORIES
INSERT INTO `blog_categories` (`id`, `name`, `slug`) VALUES
(1, 'Xu hướng', 'xu-huong'),
(2, 'Kỹ thuật', 'ky-thuat'),
(3, 'Marketing', 'marketing'),
(4, 'Kinh doanh', 'kinh-doanh'),
(5, 'Thiết kế', 'thiet-ke');

-- 8. BLOG AUTHORS
INSERT INTO `blog_authors` (`id`, `name`, `title`, `bio`, `avatar`) VALUES
(1, 'Tuấn Anh', 'Senior Fullstack Dev', '10 năm kinh nghiệm trong lĩnh vực Web Development. Đam mê chia sẻ kiến thức công nghệ.', 'https://ui-avatars.com/api/?name=Tuan+Anh&background=ea580c&color=fff');

-- 9. BLOG POSTS
-- [FIX] Đã thay link ảnh Dribbble chết bằng Placehold.co và Unsplash
INSERT INTO `blog_posts` (`id`, `category_id`, `author_id`, `title`, `slug`, `summary`, `content`, `thumbnail`, `views`, `is_featured`, `published_at`) VALUES
-- Bài 1
(1, 1, 1, '5 Xu hướng Thiết kế Website sẽ thống trị năm 2026', 'xu-huong-thiet-ke-web-2026', 
'Khám phá những phong cách UI/UX mới nhất: Từ Glassmorphism, 3D Abstract đến xu hướng tối giản Dark Mode.',
'<p>Nội dung chi tiết bài viết HTML ở đây...</p>', 
'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=800&auto=format&fit=crop', 2543, 1, '2026-02-02 08:00:00'),

-- Bài 2
(2, 2, 1, 'Tại sao Website của bạn tải chậm? Cách khắc phục ngay', 'tai-sao-website-cham', 
'Tìm hiểu nguyên nhân và cách tối ưu tốc độ tải trang.', 
'<p>Nội dung bài viết...</p>', 
'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop', 1200, 0, '2026-02-01 09:00:00'),

-- Bài 3
(3, 3, 1, 'SEO On-page là gì? Hướng dẫn cho người mới bắt đầu', 'seo-on-page-la-gi', 
'Hướng dẫn chi tiết về SEO Onpage.', 
'<p>Nội dung bài viết...</p>', 
'https://images.unsplash.com/photo-1571721795195-a2ca2d3370a9?q=80&w=800&auto=format&fit=crop', 850, 0, '2026-01-30 10:00:00'),

-- Bài 4
(4, 4, 1, 'Bí quyết tăng tỷ lệ chuyển đổi (CRO) cho Landing Page', 'bi-quyet-cro', 
'Làm sao để khách vào web là mua hàng?', 
'<p>Nội dung bài viết...</p>', 
'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=800&auto=format&fit=crop', 2100, 0, '2026-01-28 14:00:00');

-- 10. BLOG TAGS
INSERT INTO `blog_tags` (`id`, `name`, `slug`) VALUES
(1, 'WebDesign', 'web-design'), (2, '2026Trends', '2026-trends'), (3, 'UI/UX', 'ui-ux'), (4, 'SEO', 'seo');

-- 11. BLOG MAP
INSERT INTO `blog_post_tags` (`post_id`, `tag_id`) VALUES (1, 1), (1, 2), (1, 3);

-- 12. CONTACT SERVICES
INSERT INTO `contact_services` (`name`) VALUES 
('Thiết kế Website Trọn gói'), 
('Dịch vụ SEO Tổng thể'), 
('Mua Giao diện (Template)'), 
('Đăng ký Hosting/Domain');

-- 13. SYSTEM SETTINGS
-- [FIX] Sửa lỗi cú pháp ở map_iframe
INSERT INTO `system_settings` (`setting_key`, `setting_value`, `setting_group`, `desc`) VALUES
('company_name', 'HolaGroup', 'general', 'Tên công ty'),
('company_address', '119 Đường Lê Bôi, Phường 7, Quận 8, TP. HCM', 'contact', 'Địa chỉ văn phòng'),
('company_phone', '0973157932', 'contact', 'Số điện thoại chính'),
('company_email', 'sale@holagroup.com.vn', 'contact', 'Email liên hệ'),
('company_email_support', 'support@holagroup.com.vn', 'contact', 'Email hỗ trợ'),
('social_facebook', 'https://facebook.com/holagroup', 'social', 'Link Facebook'),
('social_zalo', 'https://zalo.me/0973157932', 'social', 'Link Zalo'),
('map_iframe', '<iframe src=\"https://www.google.com/maps/embed...\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'contact', 'Mã nhúng bản đồ'),
('default_title', 'Web Giá Rẻ - Thiết kế website trọn gói', 'seo', 'Tiêu đề mặc định'),
('default_desc', 'Dịch vụ thiết kế website giá rẻ, chuẩn SEO tại TP.HCM.', 'seo', 'Mô tả mặc định'),
('default_keywords', 'thiết kế web giá rẻ, làm web trọn gói', 'seo', 'Từ khóa mặc định'),
('default_share_image', 'https://placehold.co/1200x630/ea580c/white?text=HolaGroup+Share', 'seo', 'Ảnh share FB mặc định'),
('company_slogan', 'Tech Solution', 'general', 'Slogan'),
('site_logo_url', 'https://placehold.co/200x60/transparent/ea580c?text=HOLA', 'general', 'Logo Website'),
('site_favicon_url', 'https://placehold.co/32x32/ea580c/white?text=H', 'general', 'Favicon'),
('cta_title', 'Sẵn sàng bứt phá doanh thu?', 'general', 'Tiêu đề CTA'),
('cta_desc', 'Đừng để đối thủ vượt mặt bạn.', 'general', 'Mô tả CTA'),
('cta_note', 'Tư vấn miễn phí 100%', 'general', 'Ghi chú CTA');

-- 14. ADMINS
-- User: admin / Pass: 123456
INSERT INTO `admins` (`username`, `password`, `full_name`) VALUES
('admin', '$2y$10$aBjBQx.zyO6Ucq94qkCvLunCvo9IKphaebenL6xVWcGRCOkF2wUVm', 'Super Admin');

-- 15. PAGES (HOME)
INSERT INTO `pages` (`slug`, `name`, `meta_title`, `meta_desc`, `content_json`) VALUES
(
    'home',
    'Trang chủ',
    'Web Giá Rẻ - Thiết kế website trọn gói uy tín, chuyên nghiệp',
    'Dịch vụ thiết kế website giá rẻ, chuẩn SEO tại TP.HCM. Kho giao diện đẹp, load nhanh, bảo hành trọn đời.',
    '{
        "hero": {
            "badge": "Công nghệ Web 2026",
            "title_line_1": "Biến ý tưởng kinh doanh",
            "title_highlight": "Cỗ máy in tiền",
            "description": "Chúng tôi không chỉ thiết kế website. Chúng tôi xây dựng nền tảng kỹ thuật số giúp bạn <strong>bán hàng tự động</strong>, tối ưu SEO và nâng tầm thương hiệu.",
            "btn_primary_text": "Bắt đầu ngay",
            "btn_primary_link": "#bao-gia",
            "btn_secondary_text": "Xem mẫu giao diện",
            "btn_secondary_link": "#kho-giao-dien"
        },
        "feature_intro": {
            "title_prefix": "Không chỉ là Website, đó là",
            "title_highlight": "Vũ khí cạnh tranh",
            "desc": "Chúng tôi trang bị cho bạn những công nghệ mới nhất để vượt mặt đối thủ."
        },
        "feature_items": {
            "speed": {
                "title": "Tốc độ tải trang < 0.5s",
                "desc": "Google yêu thích website nhanh. Khách hàng ghét chờ đợi...",
                "sub_1": "Hosting SSD NVMe cao cấp",
                "sub_2": "Công nghệ Caching đa tầng"
            },
            "seo": {
                "title": "Chuẩn SEO từ gốc",
                "desc": "Cấu trúc HTML Semantic, Schema Markup, Meta Tags tự động..."
            },
            "mobile": {
                "title": "Mobile First",
                "desc": "Giao diện hiển thị hoàn hảo trên mọi thiết bị..."
            }
        },
        "security": {
            "title": "Bảo mật cấp ngân hàng",
            "desc": "Đừng để hacker phá hoại công việc kinh doanh của bạn...",
            "link_text": "Tìm hiểu thêm",
            "link_url": "#security-details"
        },
        "template_intro": {
            "title": "Giao diện",
            "highlight": "Đẳng cấp",
            "desc": "Hàng trăm mẫu thiết kế chuẩn chỉnh cho đa ngành nghề.",
            "btn_all_text": "Xem tất cả mẫu",
            "btn_all_link": "/kho-giao-dien"
        },
        "template_items": {
            "item_1": {
                "cat": "Thương mại điện tử",
                "name": "Shop Thời Trang Modern",
                "btn_text": "Xem Demo",
                "btn_url": "#demo-fashion"
            },
            "item_2": {
                "cat": "Doanh nghiệp",
                "name": "Corporate Pro",
                "btn_text": "Xem Demo",
                "btn_url": "#demo-corp"
            },
            "item_3": {
                "cat": "Landing Page",
                "name": "Bất Động Sản Luxury",
                "btn_text": "Xem Demo",
                "btn_url": "#demo-land"
            }
        },
        "pricing_intro": {
            "title": "Đầu tư nhỏ",
            "highlight": "Hiệu quả lớn",
            "btn_text": "Trọn gói",
            "btn_link": "#full-package"
        },
        "pricing_plans": {
            "basic": {
                "name": "Khởi nghiệp",
                "price": "2.500.000",
                "desc": "Website giới thiệu cơ bản...",
                "features": ["Giao diện theo mẫu", "Hosting 1GB", "Bảo mật SSL"],
                "btn_text": "Chọn gói này",
                "btn_link": "https://zalo.me/0973157932?text=TuvanGoiBasic"
            },
            "pro": {
                "name": "Kinh doanh",
                "price": "4.900.000",
                "desc": "Đầy đủ tính năng bán hàng...",
                "features": ["Giao diện Premium", "Chuẩn SEO Pro", "Hosting NVMe 5GB", "Backup hàng ngày"],
                "btn_text": "Đăng ký ngay",
                "btn_link": "https://zalo.me/0973157932?text=TuvanGoiPro"
            },
            "enterprise": {
                "name": "Doanh nghiệp lớn",
                "price": "Liên hệ",
                "desc": "Thiết kế riêng độc quyền...",
                "features": ["Thiết kế UI/UX riêng", "Server riêng (VPS)", "Code tính năng riêng"],
                "btn_text": "Chat tư vấn",
                "btn_link": "https://zalo.me/0973157932?text=TuvanGoiEnterprise"
            }
        },
        "cta": {
            "title": "Đừng để đối thủ vượt mặt bạn trên Google",
            "desc": "Mỗi giây bạn chần chừ là một khách hàng tiềm năng đang rơi vào tay đối thủ.",
            "note": "Tư vấn miễn phí 100% • Không mua không sao"
        }
    }'
);