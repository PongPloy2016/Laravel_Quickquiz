#!/bin/bash
set -x

echo "==> [1] Starting Laravel application..."
echo "==> PHP version: $(php -v | head -1)"
echo "==> Working dir: $(pwd)"
echo "==> APP_KEY set: $([ -n "$APP_KEY" ] && echo YES || echo NO)"
echo "==> DB_HOST set: $([ -n "$DB_HOST" ] && echo YES || echo NO)"

# ถ้า Render ตั้ง DB_HOST ไว้ใน Environment Variables → ให้ overwrite .env
# ถ้าไม่ → ใช้ .env ที่ COPY มาจาก repo (local values)
if [ -n "$DB_HOST" ]; then
    echo "==> [2] DB_HOST found in env vars, writing fresh .env from Render environment..."
    cat > /var/www/html/.env << ENVEOF
APP_NAME=${APP_NAME:-QuickQuiz}
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY:-}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}
APP_LOG_LEVEL=debug

DB_CONNECTION=${DB_CONNECTION:-pgsql}
DB_HOST=${DB_HOST:-}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE:-}
DB_USERNAME=${DB_USERNAME:-}
DB_PASSWORD=${DB_PASSWORD:-}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
QUEUE_DRIVER=sync
ENVEOF

    echo "==> .env written successfully"
    cat /var/www/html/.env | grep -v PASSWORD | grep -v KEY
else
    echo "==> [2] No DB_HOST in env vars, using .env from repo..."
    cat /var/www/html/.env | grep -v PASSWORD | grep -v KEY
fi

# Generate APP_KEY ถ้าว่าง
if [ -z "$APP_KEY" ]; then
    echo "==> [3] APP_KEY is empty, generating..."
    php artisan key:generate --force 2>&1 || echo "WARNING: key:generate failed"
else
    echo "==> [3] APP_KEY already set, skipping key:generate"
fi

# Clear caches
echo "==> [4] Clearing Laravel caches..."
php artisan config:clear 2>&1 || echo "WARNING: config:clear failed"
php artisan route:clear  2>&1 || echo "WARNING: route:clear failed"
php artisan view:clear   2>&1 || echo "WARNING: view:clear failed"

# ตั้งสิทธิ์
echo "==> [5] Setting permissions..."
mkdir -p storage/framework/cache/data \
         storage/framework/sessions \
         storage/framework/views \
         bootstrap/cache 2>&1 || true
chown -R www-data:www-data storage bootstrap/cache 2>&1 || true
chmod -R 775 storage bootstrap/cache 2>&1 || true

# Run migrations
echo "==> [6] Running migrations..."
php artisan migrate --force 2>&1 || echo "WARNING: migrate failed (continuing)"

echo "==> [7] Starting Apache..."
exec apache2-foreground
