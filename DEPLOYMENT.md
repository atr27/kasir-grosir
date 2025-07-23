# Laravel Cloud Deployment Guide

This guide will help you deploy your Kasir Grosir application to Laravel Cloud.

## Prerequisites

1. **Laravel Cloud Account**: Sign up for Laravel Cloud (currently in beta)
2. **Git Repository**: Push your code to GitHub, GitLab, or Bitbucket
3. **Environment Variables**: Configure production environment variables

## Deployment Steps

### 1. Push to Git Repository

```bash
git add .
git commit -m "Prepare for Laravel Cloud deployment"
git push origin main
```

### 2. Connect to Laravel Cloud

1. Log in to your Laravel Cloud dashboard
2. Click "New Project"
3. Connect your Git repository
4. Select the repository containing this Laravel application

### 3. Configure Environment Variables

In your Laravel Cloud project settings, add these environment variables:

```env
APP_NAME="Kasir Grosir"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-domain.laravel.app

DB_CONNECTION=mysql
DB_HOST=YOUR_DB_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USER
DB_PASSWORD=YOUR_DB_PASSWORD

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=redis

MAIL_MAILER=smtp
MAIL_HOST=YOUR_MAIL_HOST
MAIL_PORT=587
MAIL_USERNAME=YOUR_MAIL_USERNAME
MAIL_PASSWORD=YOUR_MAIL_PASSWORD
MAIL_ENCRYPTION=tls

FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=YOUR_AWS_KEY
AWS_SECRET_ACCESS_KEY=YOUR_AWS_SECRET
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=YOUR_S3_BUCKET
```

### 4. Database Setup

Laravel Cloud will automatically:
- Create a MySQL database
- Run migrations during deployment
- Set up Redis for caching

### 5. File Storage

For file uploads and storage:
- Configure S3 bucket for production
- Update `FILESYSTEM_DISK=s3` in environment variables
- Ensure AWS credentials are properly set

### 6. Deploy

1. Click "Deploy" in your Laravel Cloud dashboard
2. Monitor the build process
3. Check deployment logs for any issues

## Post-Deployment Tasks

### 1. Generate Application Key

If not set, generate a new application key:
```bash
php artisan key:generate
```

### 2. Run Database Seeders (if needed)

```bash
php artisan db:seed
```

### 3. Set Up Scheduled Tasks

Laravel Cloud automatically handles `php artisan schedule:run`

### 4. Configure Domain

1. Add your custom domain in Laravel Cloud settings
2. Update DNS records to point to Laravel Cloud
3. SSL certificates are automatically managed

## Important Notes

- **Database**: Your current app uses SQLite locally but will use MySQL in production
- **File Storage**: Local storage will be replaced with S3 in production
- **Caching**: Redis will be used for caching and sessions
- **Queue Processing**: Background jobs will be processed automatically

## Troubleshooting

### Common Issues:

1. **Migration Errors**: Ensure all migrations are compatible with MySQL
2. **File Upload Issues**: Verify S3 configuration and permissions
3. **Environment Variables**: Double-check all required variables are set

### Logs Access:

Access application logs through Laravel Cloud dashboard or use:
```bash
php artisan log:show
```

## Local Development vs Production

| Feature | Local | Production |
|---------|-------|------------|
| Database | SQLite | MySQL |
| Storage | Local | S3 |
| Cache | File | Redis |
| Queue | Sync | Database |
| Mail | Log | SMTP |

## Support

- Laravel Cloud Documentation: https://laravel.com/docs/cloud
- Laravel Community: https://laravel.io
- GitHub Issues: Create issues in your repository

---

**Note**: Laravel Cloud is currently in beta. Features and pricing may change.
