#!/bin/bash

# Auto Backup Database + Media Files Script cho WebGiare
# Cron: Chạy tự động lúc 2h sáng mỗi ngày trong container backup
# Chạy thủ công: docker exec webgiare_backup bash /workspace/backup-db.sh

# Đường dẫn trong container (được mount từ ./docker trên host)
WORKSPACE_DIR="/workspace"
BACKUP_DIR="$WORKSPACE_DIR/backups"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")

# Tạo thư mục backup nếu chưa có
mkdir -p "$BACKUP_DIR"

echo "🗄️  [$(date)] Bắt đầu backup..."

# ==================== BACKUP DATABASE ====================

# Backup MySQL
echo "📦 Backup MySQL..."
# Sử dụng mysql-client kết nối trực tiếp đến service 'db' qua network của docker
mysqldump -h db -u root -p"${MYSQL_ROOT_PASSWORD}" "${DB_NAME:-webgiare_db}" > "$BACKUP_DIR/webgiare_db_$TIMESTAMP.sql"
if [ $? -eq 0 ]; then
    echo "✅ [$(date)] Backup MySQL: webgiare_db_$TIMESTAMP.sql"
else
    echo "❌ [$(date)] Backup MySQL thất bại!"
fi

# Backup PostgreSQL (umami)
echo "📦 Backup PostgreSQL (Umami)..."
PGPASSWORD="${UMAMI_PASSWORD:-admin}" pg_dump -h umami_db -U "${UMAMI_USER:-admin}" "${UMAMI_DB:-umami}" > "$BACKUP_DIR/umami_$TIMESTAMP.sql"
if [ $? -eq 0 ]; then
    echo "✅ [$(date)] Backup PostgreSQL: umami_$TIMESTAMP.sql"
else
    echo "❌ [$(date)] Backup PostgreSQL thất bại!"
fi

# ==================== BACKUP MEDIA FILES ====================

echo "📦 Backup MinIO (ảnh/upload)..."
cd "$WORKSPACE_DIR"
# Nén thư mục minio_data
tar -czf "$BACKUP_DIR/minio_data_$TIMESTAMP.tar.gz" minio_data 2>/dev/null

if [ -f "$BACKUP_DIR/minio_data_$TIMESTAMP.tar.gz" ]; then
    echo "✅ [$(date)] Backup MinIO: minio_data_$TIMESTAMP.tar.gz"
else
    echo "❌ [$(date)] Backup MinIO thất bại!"
fi

# ==================== CLEANUP OLD BACKUPS ====================

# Xóa backup cũ (giữ lại 7 bản)
cd "$BACKUP_DIR"
ls -t webgiare_db_*.sql 2>/dev/null | tail -n +8 | xargs -r rm -f
ls -t umami_*.sql 2>/dev/null | tail -n +8 | xargs -r rm -f
ls -t minio_data_*.tar.gz 2>/dev/null | tail -n +8 | xargs -r rm -f

# Đếm số backup còn lại
MYSQL_BACKUPS=$(ls -1 webgiare_db_*.sql 2>/dev/null | wc -l)
POSTGRES_BACKUPS=$(ls -1 umami_*.sql 2>/dev/null | wc -l)
MINIO_BACKUPS=$(ls -1 minio_data_*.tar.gz 2>/dev/null | wc -l)

echo ""
echo "🎉 [$(date)] Backup hoàn tất!"
echo "📁 MySQL: $MYSQL_BACKUPS | PostgreSQL: $POSTGRES_BACKUPS | MinIO: $MINIO_BACKUPS"
echo ""
echo "📋 Các file backup:"
ls -lh "$BACKUP_DIR/"

