FROM php:8.4-apache

# Install system dependencies and PHP extensions for SQLite & PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libsqlite3-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite zip opcache \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure Apache DocumentRoot to point to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy Composer from official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Install PHP dependencies for production
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Normalize line endings on startup script and set permissions for Laravel writable directories
RUN sed -i 's/\r$//' /var/www/html/scripts/render-start.sh \
    && chmod +x /var/www/html/scripts/render-start.sh \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80

CMD ["/var/www/html/scripts/render-start.sh"]
