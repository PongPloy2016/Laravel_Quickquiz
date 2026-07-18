#!/usr/bin/env bash

echo "==> Running composer install..."
composer install --no-dev --working-dir=/var/www/html

echo "==> Caching config..."
php artisan config:cache

echo "==> Caching routes..."
php artisan route:cache

echo "==> Caching views..."
php artisan view:cache

echo "==> Running migrations..."
php artisan migrate --force || echo "WARNING: Migrate failed, continuing..."

echo "==> Setting permissions..."
chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Deploy script completed!"
