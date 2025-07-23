#!/bin/bash

# Laravel Cloud Deployment Script
# This script helps prepare your application for Laravel Cloud deployment

echo "🚀 Preparing Kasir Grosir for Laravel Cloud deployment..."

# Check if we're in a git repository
if [ ! -d ".git" ]; then
    echo "❌ This is not a git repository. Please initialize git first:"
    echo "   git init"
    echo "   git add ."
    echo "   git commit -m 'Initial commit'"
    exit 1
fi

# Check if composer.json exists
if [ ! -f "composer.json" ]; then
    echo "❌ composer.json not found. Are you in the Laravel project root?"
    exit 1
fi

echo "✅ Git repository detected"
echo "✅ Laravel project detected"

# Install dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Install NPM dependencies
echo "📦 Installing NPM dependencies..."
npm ci

# Build assets
echo "🏗️  Building assets..."
npm run build

# Clear and cache configurations
echo "⚡ Optimizing Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Generate optimized files
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check for common issues
echo "🔍 Checking for potential deployment issues..."

# Check if APP_KEY is set
if grep -q "APP_KEY=$" .env 2>/dev/null; then
    echo "⚠️  Warning: APP_KEY is not set in .env file"
    echo "   Run: php artisan key:generate"
fi

# Check if storage is linked
if [ ! -L "public/storage" ]; then
    echo "⚠️  Warning: Storage link not created"
    echo "   Run: php artisan storage:link"
fi

echo ""
echo "✅ Pre-deployment checks completed!"
echo ""
echo "📋 Next steps for Laravel Cloud deployment:"
echo "1. Push your code to Git repository:"
echo "   git add ."
echo "   git commit -m 'Prepare for deployment'"
echo "   git push origin main"
echo ""
echo "2. Go to Laravel Cloud dashboard"
echo "3. Create new project and connect your repository"
echo "4. Configure environment variables (see DEPLOYMENT.md)"
echo "5. Deploy your application"
echo ""
echo "📖 For detailed instructions, see DEPLOYMENT.md"
