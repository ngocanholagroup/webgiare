# WebGiare - Dự án Website Bán Template

## 🚀 Cài Đặt & Chạy Dự Án

### Yêu cầu
- Docker Desktop (Windows/Mac/Linux)
- Docker Compose

### Các bước cài đặt

```bash
# 1. Clone project và di chuyển vào thư mục
cd webgiare

# 2. Chạy Docker (lần đầu sẽ tạo database và seed data)
docker-compose up -d

# 3. Đợi khoảng 1-2 phút để các service khởi động hoàn tất

# 4. Truy cập các địa chỉ:
- Website:        http://localhost:8080
- phpMyAdmin:     http://localhost:8081
- Umami Analytics: http://localhost:3000
```

### Tài khoản đăng nhập

| Service | Username | Password |
|---------|----------|----------|
| Admin Panel | `admin` | `123456` |
| phpMyAdmin | `root` | `root` |
| Umami | `admin` | `umami` |

---

## 📁 Cấu Trúc Dữ Liệu

Dữ liệu được lưu trong thư mục `docker/`:

```
docker/
├── mysql_data/           # Database MySQL
├── umami_postgres_data/ # Database PostgreSQL (Umami)
└── backups/             # File backup tự động
```

Ảnh upload được lưu tại: `src/uploads/`

---

## 💾 Backup & Restore

### Backup Tự Động
- Hệ thống tự động backup lúc **2h sáng mỗi ngày**
- File backup lưu tại: `docker/backups/`

### Backup Thủ Công
```bash
docker exec webgiare_backup /workspace/backup-db.sh
```

### Restore Dữ Liệu

```bash
# Xem các file backup có sẵn
ls -la docker/backups/

# Restore database
./docker/restore-db.sh db webgiare_db_YYYYMMDD_HHMMSS.sql

# Restore ảnh (Local uploads)
./docker/restore-db.sh uploads uploads_YYYYMMDD_HHMMSS.tar.gz
```

---

## ⚠️ Lưu Ý Quan Trọng

### Không xóa thư mục `docker/`
- Thư mục `docker/` chứa TẤT CẢ dữ liệu của bạn
- **KHÔNG** xóa thư mục này nếu muốn giữ dữ liệu

### Các lệnh Docker an toàn

| Lệnh | Dữ liệu | Dùng khi |
|------|---------|----------|
| `docker-compose down` | ✅ Giữ nguyên | Restart bình thường |
| `docker-compose down -v` | ✅ Giữ nguyên | Restart có init.sql |
| `docker system prune -a` | ✅ Giữ nguyên | Dọn dẹp Docker |
| `rm -rf docker/*` | ❌ Mất hết! | KHÔNG BAO GIỜ |

### Reset Database (xóa toàn bộ dữ liệu)

Nếu cần reset về trạng thái ban đầu:

```bash
# Cách 1: Xóa thư mục data và restart
rm -rf docker/mysql_data docker/umami_postgres_data src/uploads
docker-compose down
docker-compose up -d

# Cách 2: Bỏ comment init.sql trong docker-compose.yml rồi chạy
# (xem phần "Setup lần đầu" bên dưới)
```

---

## 🔧 Cấu Hình

### Các biến môi trường
Chỉnh sửa file `.env`:

```env
# Database
DB_NAME=webgiare_dev
DB_USER=webgiare_user
DB_PASS=root

# Umami
UMAMI_DB=admin
UMAMI_USER=admin
UMAMI_PASSWORD=umami
```

---

## 📋 Các Service

| Service | Port | Mô tả |
|---------|------|--------|
| Web (PHP+Apache) | 8080 | Ứng dụng chính |
| MySQL | 3306 | Database |
| phpMyAdmin | 8081 | Quản lý MySQL |
| Umami Analytics | 3000 | Thống kê truy cập |
| PostgreSQL | 5432 | Database Umami |

---

## 🆘 Khắc Phục Sự Cố

### Container không khởi động được
```bash
# Xem logs
docker-compose logs [ten_container]

# Ví dụ:
docker-compose logs web
docker-compose logs db
```

### Xóa và chạy lại từ đầu
```bash
# Dừng và xóa tất cả
docker-compose down

# Xóa dữ liệu (CẨN THẬN!)
rm -rf docker/mysql_data docker/umami_postgres_data src/uploads

# Chạy lại
docker-compose up -d
```

### Backup thủ công không chạy
```bash
# Kiểm tra container backup
docker logs webgiare_backup

# Chạy thủ công
docker exec webgiare_backup sh /workspace/backup-db.sh
```

---

## 📝 Giấy phép

Copyright © 2026 HolaGroup
