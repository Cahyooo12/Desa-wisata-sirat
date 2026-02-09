#!/bin/bash
set -e

echo "Installing Composer dependencies (production only)..."
composer install --optimize-autoloader --no-dev --no-interaction

echo "Laravel optimization..."
php artisan config:cache || true
php artisan route:cache || true

echo "Setup storage link..."
php artisan storage:link || true

echo "Build complete!"
