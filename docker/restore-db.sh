#!/bin/bash

# Restore Database + MinIO Script cho WebGiare
# Cách dùng: 
#   Restore database: ./docker/restore-db.sh db <ten_file_sql>
#   Restore MinIO:    ./docker/restore-db.sh minio <ten_file_tar.gz>
#   Restore all:      ./docker/restore-db.sh all <ten_file_sql>

MODE=${1:-}
BACKUP_FILE=${2:-}
BACKUP_DIR="./docker/backups"

if [ -z "$MODE" ] || [ -z "$BACKUP_FILE" ]; then
    echo "❌ Cách dùng:"
    echo "   ./docker/restore-db.sh db <file_sql>"
    echo "   ./docker/restore-db.sh minio <file_tar.gz>"  
    echo "   ./docker/restore-db.sh all <file_sql> [minio_file]"
    echo ""
    echo "📋 Các file backup có sẵn:"
    ls -la $BACKUP_DIR/
    exit 1
fi

echo "⚠️  CẢNH BÁO: Restore sẽ xóa toàn bộ dữ liệu hiện tại!"
echo "📄 File restore: $BACKUP_FILE"
read -p "Bạn có chắc muốn tiếp tục? (yes/no): " confirm

if [ "$confirm" != "yes" ]; then
    echo "❌ Hủy restore."
    exit 0
fi

# ==================== RESTORE DATABASE ====================
restore_db() {
    local sql_file=$1
    
    if [ ! -f "$BACKUP_DIR/$sql_file" ]; then
        echo "❌ File không tồn tại: $BACKUP_DIR/$sql_file"
        exit 1
    fi
    
    echo "🗄️  Restore MySQL database..."
    docker exec -i webgiare_db mysql -u root -proot webgiare_db < "$BACKUP_DIR/$sql_file"
    
    if [ $? -eq 0 ]; then
        echo "✅ Restore MySQL thành công!"
    else
        echo "❌ Restore MySQL thất bại!"
        exit 1
    fi
}

# ==================== RESTORE MINIO ====================
restore_minio() {
    local tar_file=$1
    
    if [ ! -f "$BACKUP_DIR/$tar_file" ]; then
        echo "❌ File không tồn tại: $BACKUP_DIR/$tar_file"
        exit 1
    fi
    
    echo "🗄️  Dừng MinIO service..."
    docker-compose stop minio
    
    echo "🗄️  Restore MinIO data..."
    rm -rf ./docker/minio_data/*
    tar -xzf "$BACKUP_DIR/$tar_file" -C ./docker/
    
    echo "🗄️  Khởi động lại MinIO..."
    docker-compose up -d minio
    
    echo "✅ Restore MinIO thành công!"
}

# ==================== EXECUTE ====================
case $MODE in
    db)
        restore_db $BACKUP_FILE
        ;;
    minio)
        restore_minio $BACKUP_FILE
        ;;
    all)
        restore_db $BACKUP_FILE
        if [ -n "$3" ]; then
            restore_minio $3
        else
            # Tìm file minio gần nhất
            MINIO_FILE=$(ls -t minio_data_*.tar.gz 2>/dev/null | head -1)
            if [ -n "$MINIO_FILE" ]; then
                restore_minio $MINIO_FILE
            fi
        fi
        ;;
    *)
        echo "❌ Mode không hợp lệ: $MODE"
        echo "Các mode: db, minio, all"
        exit 1
        ;;
esac

echo ""
echo "🎉 Restore hoàn tất!"
echo "🔄 Khởi động lại application..."
docker-compose restart

echo ""
echo "📁 Các file backup:"
ls -lh $BACKUP_DIR/
