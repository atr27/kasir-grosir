#!/usr/bin/env bash
# Exit on error
set -o errexit

npm ci
npm run build
php artisan optimize
php artisan migrate --force