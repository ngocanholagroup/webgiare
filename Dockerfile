FROM php:8.2-apache

# Cài đặt extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Bật mod_rewrite
RUN a2enmod rewrite

# --- THÊM ĐOẠN NÀY ---
# Cấu hình Apache để cho phép file .htaccess hoạt động trong /var/www/html
ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Cho phép AllowOverride All (quan trọng cho .htaccess)
RUN echo '<Directory /var/www/html/>' >> /etc/apache2/apache2.conf
RUN echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf
RUN echo '    AllowOverride All' >> /etc/apache2/apache2.conf
RUN echo '    Require all granted' >> /etc/apache2/apache2.conf
RUN echo '</Directory>' >> /etc/apache2/apache2.conf
# ---------------------

WORKDIR /var/www/html