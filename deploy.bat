@echo off
echo 🚀 Preparing Kasir Grosir for Laravel Cloud deployment...

REM Check if we're in a git repository
if not exist ".git" (
    echo ❌ This is not a git repository. Please initialize git first:
    echo    git init
    echo    git add .
    echo    git commit -m "Initial commit"
    pause
    exit /b 1
)

REM Check if composer.json exists
if not exist "composer.json" (
    echo ❌ composer.json not found. Are you in the Laravel project root?
    pause
    exit /b 1
)

echo ✅ Git repository detected
echo ✅ Laravel project detected

REM Install dependencies
echo 📦 Installing Composer dependencies...
composer install --no-dev --optimize-autoloader

REM Install NPM dependencies
echo 📦 Installing NPM dependencies...
npm ci

REM Build assets
echo 🏗️  Building assets...
npm run build

REM Clear and cache configurations
echo ⚡ Optimizing Laravel...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

REM Generate optimized files
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo.
echo ✅ Pre-deployment checks completed!
echo.
echo 📋 Next steps for Laravel Cloud deployment:
echo 1. Push your code to Git repository:
echo    git add .
echo    git commit -m "Prepare for deployment"
echo    git push origin main
echo.
echo 2. Go to Laravel Cloud dashboard
echo 3. Create new project and connect your repository
echo 4. Configure environment variables (see DEPLOYMENT.md)
echo 5. Deploy your application
echo.
echo 📖 For detailed instructions, see DEPLOYMENT.md
pause
