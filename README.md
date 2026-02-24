# WebGiare - HolaGroup

Hệ thống website thương mại điện tử và bán template web của HolaGroup, được xây dựng trên nền tảng PHP thuần với kiến trúc MVC.

## 📋 Mô tả dự án

WebGiare là một nền tảng web cung cấp:
- **Blog/Tin tức**: Quản lý và hiển thị các bài viết, tin tức
- **Kho giao diện**: Kho template website chất lượng cao
- **Hệ thống quản trị**: Admin panel để quản lý nội dung
- **Liên hệ**: Form liên hệ khách hàng

## 🛠️ Công nghệ sử dụng

- **Backend**: PHP 8.2
- **Web Server**: Apache (với mod_rewrite)
- **Database**: MySQL 8.0
- **Frontend**: HTML5, CSS3, JavaScript
- **Containerization**: Docker & Docker Compose
- **Admin Tool**: phpMyAdmin

## 📁 Cấu trúc dự án

```
webgiare/
├── src/                          # Source code chính
│   ├── controllers/              # Controllers xử lý logic
│   ├── models/                   # Models tương tác database
│   ├── views/                    # Views hiển thị giao diện
│   ├── assets/                   # CSS, JS, images
│   ├── includes/                 # Các file include chung
│   ├── helpers.php               # Helper functions
│   ├── autoload.php              # Autoloader
│   ├── Router.php                # Router system
│   └── index.php                 # Entry point
├── database.sql                  # Database schema
├── docker-compose.yml            # Docker configuration
├── Dockerfile                    # Docker image build
└── README.md                     # Documentation
```

## 🚀 Cài đặt và chạy

### Yêu cầu
- Docker & Docker Compose
- Git

### Các bước thực hiện

1. **Clone repository**
```bash
git clone <repository-url>
cd webgiare
```

2. **Khởi động Docker containers**
```bash
docker-compose up -d
```

3. **Import database**
```bash
# Copy file database.sql vào container MySQL
docker cp database.sql webgiare_db:/tmp/database.sql

# Truy cập MySQL container và import
docker exec -it webgiare_db mysql -u root -prootpassword
mysql> USE webgiare_db;
mysql> SOURCE /tmp/database.sql;
mysql> EXIT;
```

4. **Kiểm tra kết quả**
- Website: http://localhost:8080
- phpMyAdmin: http://localhost:8081
  - Server: db
  - Username: root
  - Password: rootpassword

## 🔧 Cấu hình

### Database
- **Host**: db
- **Database**: webgiare_db
- **Username**: user_dev
- **Password**: userpassword

### Ports
- **Website**: 8080
- **phpMyAdmin**: 8081

## 📝 Features

### Client Features
- Trang chủ với thông tin giới thiệu
- Blog/Tin tức với danh mục và tags
- Kho giao diện với danh mục và tính năng
- Form liên hệ
- Responsive design

### Admin Features
- Quản lý bài viết blog
- Quản lý template/giao diện
- Quản lý danh mục
- Quản lý liên hệ
- Quản lý hệ thống

## 🛠️ Development

### Thêm route mới
Mở file `src/index.php` và thêm route vào phần định nghĩa:

```php
// GET route
$router->get('/path', [ControllerName::class, 'method']);

// POST route
$router->post('/path', [ControllerName::class, 'method']);
```

### Thêm controller
Tạo file mới trong `src/controllers/` với class extends từ base controller (nếu có).

### Thêm model
Tạo file mới trong `src/models/` để xử lý tương tác database.

### Database queries
Sử dụng PDO với prepared statements để đảm bảo security.

## 🐛 Debugging

### Kiểm tra kết nối database
Truy cập: http://localhost:8080/test_db.php

### Xem logs
```bash
# Xem logs của web container
docker logs webgiare_app

# Xem logs của database container
docker logs webgiare_db
```

## 📦 Commands hữu ích

```bash
# Khởi động tất cả containers
docker-compose up -d

# Dừng tất cả containers
docker-compose down

# Xóa volumes (mất dữ liệu)
docker-compose down -v

# Rebuild container
docker-compose build --no-cache

# Truy cập vào web container
docker exec -it webgiare_app bash

# Truy cập vào database container
docker exec -it webgiare_db mysql -u root -prootpassword
```

## 🔒 Security Notes

- Luôn sử dụng prepared statements cho database queries
- Validate và sanitize user input
- Không commit sensitive information (passwords, API keys)
- Sử dụng HTTPS trong production
- Regular updates cho dependencies

## 📄 License

Dự án này thuộc sở hữu của HolaGroup.

## 👥 Contributors

- HolaGroup Development Team

---

**Lưu ý**: Đây là dự án internal của HolaGroup. Vui lòng liên hệ team development trước khi thực hiện các thay đổi lớn.