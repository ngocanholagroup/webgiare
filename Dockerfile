FROM php:8.2-apache

# 1. Cài extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Bật mod_rewrite
RUN a2enmod rewrite

# 3. Cấu hình quyền truy cập thư mục (FIX LỖI 403 FORBIDDEN & 404)
# Thay vì sửa file gốc, ta tạo một file config mới tên là 'my-apache-config.conf'
# Cho phép: Liệt kê file (Indexes), Rewrite (.htaccess), và Cấp quyền truy cập (Require all granted)
RUN echo '<Directory /var/www/html/>' > /etc/apache2/conf-available/my-apache-config.conf \
    && echo '    Options Indexes FollowSymLinks' >> /etc/apache2/conf-available/my-apache-config.conf \
    && echo '    AllowOverride All' >> /etc/apache2/conf-available/my-apache-config.conf \
    && echo '    Require all granted' >> /etc/apache2/conf-available/my-apache-config.conf \
    && echo '</Directory>' >> /etc/apache2/conf-available/my-apache-config.conf \
    && a2enconf my-apache-config

# 4. Thiết lập thư mục
WORKDIR /var/www/html