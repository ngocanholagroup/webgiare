# Hướng Dẫn Deploy Webgiare

## 1. Cấu trúc thư mục và Docker
Dự án sử dụng Docker để chạy môi trường.
- **Source code:** `src/` (mount vào `/var/www/html`)
- **Uploads:** `webgiare_uploads` (Docker Volume - Không bị mất khi update code)
- **Database:** `webgiare_db` (Docker Container)

## 2. Cấu hình Môi trường (Environment)

### Trên Local (Development)
File `.env`:
```ini
APP_ENV=development
BASE_URL=http://localhost:8080
DB_HOST=db
UPLOAD_PATH=uploads/
```

### Trên Server (Production)
Tạo file `.env` từ `.env.production.example`:
```bash
cp .env.production.example .env
```
Cập nhật nội dung `.env`:
```ini
APP_ENV=production
BASE_URL=https://webgiare.cloud  <-- QUAN TRỌNG: Để link ảnh đúng
DB_HOST=db
UPLOAD_PATH=uploads/
```

## 3. Deploy Code Mới
Khi cập nhật code (git pull), chạy lệnh sau để build lại container mà **KHÔNG MẤT ẢNH**:

```bash
# 1. Pull code mới
git pull origin main

# 2. Rebuild và khởi động lại container
docker-compose up -d --build
```

Docker Volume `webgiare_uploads` sẽ giữ lại toàn bộ ảnh đã upload.

## 4. Lưu ý về Database
Nếu bạn import database từ Local lên Production, các link ảnh cũ có thể vẫn là `http://localhost:8080/...`.
Bạn cần chạy câu lệnh SQL để sửa lại link ảnh (nếu cần):

```sql
UPDATE admin_accounts SET avatar = REPLACE(avatar, 'http://localhost:8080', 'https://webgiare.cloud');
UPDATE blog_posts SET thumbnail = REPLACE(thumbnail, 'http://localhost:8080', 'https://webgiare.cloud');
-- Và các bảng khác nếu có
```
