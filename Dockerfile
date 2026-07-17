FROM php:8.3-apache

# 1. ติดตั้ง Extensions ที่ Laravel และ PostgreSQL จำเป็นต้องใช้
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    curl \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip bcmath mbstring xml

# 2. เปิดใช้งาน Apache Rewrite Module
RUN a2enmod rewrite

# 3. เปลี่ยน Apache Document Root ให้ชี้ไปที่โฟลเดอร์ public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. กำหนด Working Directory และคัดลอกโค้ด
WORKDIR /var/www/html
COPY . .

# 5. ติดตั้ง Composer (ใส่ --no-scripts เพื่อข้ามปัญหาสคริปต์ Auth::routes() พังตอน Build)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 6. ตั้งสิทธิ์โฟลเดอร์ Storage และ Cache
RUN chown -R www-data:www-data storage bootstrap/cache

# 7. คำสั่งตอนเปิด Container
CMD php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    apache2-foreground