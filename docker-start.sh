#!/bin/bash
set -e

echo "==> Starting Laravel application..."

# สร้าง .env จาก environment variables ถ้าไม่มีไฟล์
if [ ! -f /var/www/html/.env ]; then
    echo "==> .env not found, creating from environment variables..."
    cat > /var/www/html/.env <<EOF
APP_NAME=${APP_NAME:-QuickQuiz}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

DB_CONNECTION=${DB_CONNECTION:-pgsql}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
EOF
fi

# Generate APP_KEY ถ้าว่าง
if [ -z "$APP_KEY" ]; then
    echo "==> Generating APP_KEY..."
    php artisan key:generate --force
fi

# Clear caches (ไม่ให้ fail ถ้า error)
echo "==> Clearing caches..."
php artisan config:clear  || true
php artisan route:clear   || true
php artisan view:clear    || true

# ตั้งสิทธิ์อีกครั้งเผื่อ volume mount ทับ
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Run migrations (ถ้า DB พร้อม)
echo "==> Running migrations..."
php artisan migrate --force || echo "WARNING: Migration failed, continuing..."

echo "==> Starting Apache..."
exec apache2-foreground
