#!/bin/bash

# Restore Database + MinIO Script cho WebGiare
# CÁCH DÙNG:
#   Restore database: ./docker/restore-db.sh db <ten_file_sql>
#   Restore PostgreSQL: ./docker/restore-db.sh pg <ten_file_sql>
#   Restore MinIO:    ./docker/restore-db.sh minio <ten_file_tar.gz>
#   Restore all:      ./docker/restore-db.sh all <ten_file_mysql> [ten_file_minio] [ten_file_pg]

MODE=${1:-}
BACKUP_FILE=${2:-}
# Lấy thư mục chứa script hiện tại để tìm đúng thư mục backups
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BACKUP_DIR="$SCRIPT_DIR/backups"

if [ -z "$MODE" ] || [ -z "$BACKUP_FILE" ]; then
    echo "❌ Cách dùng:"
    echo "   $0 db <file_sql>"
    echo "   $0 pg <file_sql>"
    echo "   $0 minio <file_tar.gz>"
    echo "   $0 all <file_mysql> [file_minio] [file_pg]"
    echo ""
    echo "📋 Các file backup có sẵn:"
    ls -la "$BACKUP_DIR/"
    exit 1
fi

echo "⚠️  CẢNH BÁO: Restore sẽ xóa toàn bộ dữ liệu hiện tại!"
echo "📄 File restore: $BACKUP_FILE"
read -p "Bạn có chắc muốn tiếp tục? (yes/no): " confirm
confirm=$(echo $confirm | tr -d '\r')

if [ "$confirm" != "yes" ]; then
    echo "❌ Hủy restore."
    exit 0
fi

# Source .env file if it exists
if [ -f .env ]; then
    export $(cat .env | grep -v '^#' | awk '/=/ {print $1}')
elif [ -f "$SCRIPT_DIR/../.env" ]; then
    export $(cat "$SCRIPT_DIR/../.env" | grep -v '^#' | awk '/=/ {print $1}')
elif [ -f "/var/www/.env" ]; then
    export $(cat "/var/www/.env" | grep -v '^#' | awk '/=/ {print $1}')
fi

DB_NAME=${DB_NAME:-webgiare_db}
MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD:-root}
UMAMI_DB=${UMAMI_DB:-admin}
UMAMI_USER=${UMAMI_USER:-admin}

# ==================== RESTORE DATABASE ====================
restore_db() {
    local sql_file=$1

    if [ ! -f "$BACKUP_DIR/$sql_file" ]; then
        echo "❌ File không tồn tại: $BACKUP_DIR/$sql_file"
        exit 1
    fi

    echo "🗄️  Restore MySQL database..."
    docker exec -i webgiare_db mysql -u root -p"${MYSQL_ROOT_PASSWORD}" "${DB_NAME}" < "$BACKUP_DIR/$sql_file"

    if [ $? -eq 0 ]; then
        echo "✅ Restore MySQL thành công!"
    else
        echo "❌ Restore MySQL thất bại!"
        exit 1
    fi
}

# ==================== RESTORE POSTGRES ====================
restore_pg() {
    local pg_file=$1

    if [ ! -f "$BACKUP_DIR/$pg_file" ]; then
        echo "❌ File không tồn tại: $BACKUP_DIR/$pg_file"
        exit 1
    fi

    echo "🗄️  Restore PostgreSQL database..."
    # Xóa public schema cũ để tránh lỗi duplicate
    docker exec -i umami_db psql -U "${UMAMI_USER}" -d "${UMAMI_DB}" -c "DROP SCHEMA public CASCADE; CREATE SCHEMA public;"
    docker exec -i umami_db psql -U "${UMAMI_USER}" -d "${UMAMI_DB}" < "$BACKUP_DIR/$pg_file"

    if [ $? -eq 0 ]; then
        echo "✅ Restore PostgreSQL thành công!"
    else
        echo "❌ Restore PostgreSQL thất bại!"
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
    docker stop webgiare_minio

    echo "🗄️  Restore MinIO data..."
    # Sử dụng webgiare_backup để thao tác file, tránh lỗi path mapping khi chạy qua PHP
    docker exec -i webgiare_backup sh -c "rm -rf /workspace/minio_data/* /workspace/minio_data/.* 2>/dev/null || true"
    docker exec -i webgiare_backup sh -c "tar -xzf /workspace/backups/$tar_file -C /workspace/"

    echo "🗄️  Khởi động lại MinIO..."
    docker start webgiare_minio
    
    echo "✅ Restore MinIO thành công!"
}

# ==================== EXECUTE ====================
case $MODE in
    db)
        restore_db $BACKUP_FILE
        ;;
    pg)
        restore_pg $BACKUP_FILE
        ;;
    minio)
        restore_minio $BACKUP_FILE
        ;;
    all)
        restore_db $BACKUP_FILE
        
        # Restore MinIO
        if [ -n "$3" ]; then
            restore_minio $3
        else
            # Tìm file minio gần nhất
            MINIO_FILE=$(ls -t $BACKUP_DIR/minio_data_*.tar.gz 2>/dev/null | head -1 | xargs basename)
            if [ -n "$MINIO_FILE" ]; then
                restore_minio $MINIO_FILE
            fi
        fi

        # Restore PG
        if [ -n "$4" ]; then
            restore_pg $4
        else
            # Tìm file pg gần nhất
            PG_FILE=$(ls -t $BACKUP_DIR/umami_*.sql 2>/dev/null | head -1 | xargs basename)
            if [ -n "$PG_FILE" ]; then
                restore_pg $PG_FILE
            fi
        fi
        ;;
    *)
        echo "❌ Mode không hợp lệ: $MODE"
        echo "Các mode: db, pg, minio, all"
        exit 1
        ;;
esac

echo ""
echo "🎉 Restore hoàn tất!"
# Không cần khởi động lại webgiare_app vì có thể làm đứt kết nối nếu đang chạy qua UI

echo ""
echo "📁 Các file backup:"
ls -lh $BACKUP_DIR/
