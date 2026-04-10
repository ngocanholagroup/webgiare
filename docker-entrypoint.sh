#!/bin/bash
set -e

echo ""
echo "🚀  WebGiare Application Container Starting..."
echo "🐘  PHP $(php -v | head -n 1)"
echo "🕸️   Apache Server is warming up..."
echo "🔌  Connecting to Database and Media Services..."
echo "✅  Environment Configured."

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL..."
max_attempts=30
attempt=0
while [ $attempt -lt $max_attempts ]; do
    if php -r "
        require_once '/var/www/html/config.php';
        \$db = Config::getDatabaseConfig();
        try {
            \$conn = new PDO(
                'mysql:host=' . \$db['host'] . ';port=' . \$db['port'] . ';dbname=' . \$db['database'],
                \$db['username'],
                \$db['password']
            );
            echo 'OK';
        } catch (PDOException \$e) {
            exit(1);
        }
    " 2>/dev/null | grep -q "OK"; then
        echo "✅ MySQL is ready!"
        break
    fi
    attempt=$((attempt + 1))
    echo "Attempt $attempt/$max_attempts..."
    sleep 2
done

if [ $attempt -eq $max_attempts ]; then
    echo "❌ MySQL not ready after $max_attempts attempts"
fi

# Run database migrations
# Removed unused migrate.php execution

# Seed default data if needed

echo "🌟  Ready to serve requests!"
echo ""

# Cấu hình Auto Backup bằng Cron (03:00 AM VN = 20:00 UTC)
echo "📅 Configuring Auto Backup Cron Job..."
echo "0 20 * * * root php /var/www/html/cron_backup.php >> /var/www/backups/cron.log 2>&1" > /etc/cron.d/auto-backup
chmod 0644 /etc/cron.d/auto-backup
crontab /etc/cron.d/auto-backup
service cron start
echo "✅ Auto Backup scheduled at 03:00 AM VN time."
echo ""

# Execute the CMD from Dockerfile
exec docker-php-entrypoint apache2-foreground
