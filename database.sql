-- --------------------------------------------------------
-- PHẦN 1: CHỌN DATABASE VÀ RESET DỮ LIỆU CŨ
-- --------------------------------------------------------

-- Sử dụng database webgiare_db
USE webgiare_db;

-- Tắt kiểm tra khóa ngoại để xóa bảng dễ dàng hơn
SET FOREIGN_KEY_CHECKS = 0;

-- Xóa các bảng cũ nếu tồn tại (theo thứ tự ngược lại của việc tạo)
DROP TABLE IF EXISTS `template_features`;
DROP TABLE IF EXISTS `template_tech_map`;
DROP TABLE IF EXISTS `template_technologies`;
DROP TABLE IF EXISTS `template_techs`;
DROP TABLE IF EXISTS `template_images`;
DROP TABLE IF EXISTS `templates`;
DROP TABLE IF EXISTS `template_categories`;

-- Bật lại kiểm tra khóa ngoại
SET FOREIGN_KEY_CHECKS = 1;

-- --------------------------------------------------------
-- PHẦN 2: TẠO BẢNG MỚI (CẤU TRÚC ĐÃ ĐỔI TÊN)
-- --------------------------------------------------------

-- 1. Bảng Danh mục Giao diện (Đổi từ categories -> template_categories)
CREATE TABLE `template_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Bảng Sản phẩm/Giao diện
CREATE TABLE `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL, -- Mã sản phẩm
  `description` longtext,
  `price` decimal(15,0) NOT NULL DEFAULT '0',
  `sale_price` decimal(15,0) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
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
  -- Khóa ngoại trỏ về template_categories
  CONSTRAINT `fk_tpl_cat` FOREIGN KEY (`category_id`) REFERENCES `template_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Bảng Hình ảnh chi tiết
CREATE TABLE `template_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `type` enum('main','gallery','mobile_demo') DEFAULT 'gallery',
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  CONSTRAINT `fk_img_tpl` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Bảng Công nghệ (Đổi từ technologies -> template_techs)
CREATE TABLE `template_techs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Bảng trung gian Template - Công nghệ (Đổi từ template_technologies -> template_tech_map)
CREATE TABLE `template_tech_map` (
  `template_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL,
  PRIMARY KEY (`template_id`,`tech_id`),
  CONSTRAINT `fk_map_tpl` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_map_tech` FOREIGN KEY (`tech_id`) REFERENCES `template_techs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Bảng Tính năng nổi bật
CREATE TABLE `template_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `feature_text` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  CONSTRAINT `fk_feat_tpl` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- PHẦN 3: THÊM DỮ LIỆU MẪU (SEED DATA)
-- --------------------------------------------------------

-- Thêm danh mục (vào bảng template_categories)
INSERT INTO `template_categories` (`id`, `name`, `slug`) VALUES
(1, 'Bán hàng', 'ban-hang'),
(2, 'Bất động sản', 'bds'),
(3, 'Doanh nghiệp', 'doanh-nghiep'),
(4, 'Landing Page', 'landing'),
(5, 'Blog/Tin tức', 'blog');

-- Thêm Template số 1
INSERT INTO `templates` (`id`, `category_id`, `name`, `slug`, `sku`, `description`, `price`, `sale_price`, `thumbnail`, `score_mobile`, `score_desktop`) VALUES
(1, 1, 'TechZone - Siêu thị điện máy', 'techzone-sieu-thi-dien-may', 'THEME-001', 'TechZone là mẫu website bán hàng hiện đại...', 3500000, 2500000, 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 98, 100);

-- Thêm Ảnh cho Template 1
INSERT INTO `template_images` (`template_id`, `image_url`, `type`) VALUES
(1, 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'main'),
(1, 'https://images.unsplash.com/photo-1556742049-0cfed4f7a07d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'gallery'),
(1, 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'mobile_demo');

-- Thêm Công nghệ (vào bảng template_techs)
INSERT INTO `template_techs` (`id`, `name`) VALUES (1, 'HTML5'), (2, 'CSS3'), (3, 'Bootstrap 5'), (4, 'PHP 8');

-- Gắn công nghệ vào Template 1 (vào bảng template_tech_map)
INSERT INTO `template_tech_map` (`template_id`, `tech_id`) VALUES (1, 1), (1, 2), (1, 3), (1, 4);

-- Thêm Tính năng nổi bật
INSERT INTO `template_features` (`template_id`, `feature_text`) VALUES 
(1, 'Giao diện Mobile-First tối ưu'), 
(1, 'Bộ lọc sản phẩm đa tầng'),
(1, 'Tối ưu SEO On-page');