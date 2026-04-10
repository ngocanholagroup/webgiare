FROM php:8.2-apache

# Cài đặt dependencies cho GD và extensions
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    git \
    unzip \
    zip \
    docker.io \
    sudo \
    mariadb-client \
    postgresql-client \
    cron \
    && rm -rf /var/lib/apt/lists/*

# Cho phép www-data chạy sudo không cần pass
RUN echo "www-data ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers

# Cài đặt PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Cài đặt và cấu hình GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

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

# Copy custom entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]