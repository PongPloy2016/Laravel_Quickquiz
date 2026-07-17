FROM php:8.3-apache

# 1. ติดตั้ง Extensions ที่ Laravel จำเป็นต้องใช้
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

# 5. ติดตั้ง Composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 6. บังคับทำ dump-autoload หลังจากไฟล์เข้ามาครบ เพื่อเคลียร์ปัญหาคลาสพัง (เพิ่มบรรทัดนี้)
RUN composer dump-autoload --optimize --no-scripts

# 7. สร้างโฟลเดอร์และตั้งสิทธิ์ Permission
RUN mkdir -p storage/framework/cache/data \
    storage/framework/app/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# 8. คำสั่งเปิดรันเว็บ (เอา php artisan ออกไปก่อนเพื่อทดสอบว่า Apache บูทผ่านไหม)
CMD apache2-foreground