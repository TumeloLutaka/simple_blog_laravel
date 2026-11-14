#!/usr/bin/env bash
set -e

cd /var/www/html

# Ensure SQLite database file exists and is writable when using SQLite
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_FILE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    mkdir -p "$(dirname "$DB_FILE")"
    touch "$DB_FILE"
    chown -R www-data:www-data "$(dirname "$DB_FILE")"
    chmod 664 "$DB_FILE"
fi

# Generate a fallback APP_KEY at runtime if none was provided via Render Environment Variables
if [ -z "$APP_KEY" ]; then
    echo "Notice: APP_KEY is not set. Generating a temporary runtime key..."
    export APP_KEY=$(php artisan key:generate --show)
fi

echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running database migrations and demo seeder..."
php artisan migrate --force --seed

# Ensure storage and database remain writable by Apache's www-data user
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

echo "Starting Apache..."
exec apache2-foreground
