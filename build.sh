#!/bin/bash

echo "🚀 Building Laravel application for Railway..."

# Install production dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache Laravel configurations
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Create SQLite database if it doesn't exist
touch database/database.sqlite

echo "✅ Build completed successfully!"
