FROM php:8.2-apache

# 1. ติดตั้ง Extensions ที่ Laravel และ PostgreSQL จำเป็นต้องใช้
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip

# 2. เปิดใช้งาน Apache Rewrite Module สำหรับจัดการ Routing ของ Laravel
RUN a2enmod rewrite

# 3. เปลี่ยน Apache Document Root ให้ชี้ไปที่โฟลเดอร์ public ของ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. กำหนด Working Directory และคัดลอกโค้ดทั้งหมดเข้า Container
WORKDIR /var/www/html
COPY . .

# 5. ติดตั้ง Composer และโหลด Libraries (ข้าม dev dependencies เพื่อความเร็วและประหยัดพื้นที่)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. ตั้งสิทธิ์ (Permission) ให้ Apache สามารถเขียนไฟล์ลงโฟลเดอร์ Storage และ Cache ได้
RUN chown -R www-data:www-data storage bootstrap/cache

# 7. คำสั่งที่จะรันตอนเปิด Container (ทำ Cache, รัน Migration อัตโนมัติ และเปิดเว็บ)
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    apache2-foreground