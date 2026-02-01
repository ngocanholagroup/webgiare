# Sử dụng PHP 8.2 kèm Apache
FROM php:8.2-apache

# Cài đặt các extension cần thiết cho MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Bật mod_rewrite của Apache (hữu ích nếu bạn làm router cho PHP thuần sau này)
RUN a2enmod rewrite

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Copy source code vào container (tùy chọn, vì chúng ta sẽ mount volume ở docker-compose)
# COPY ./src /var/www/html