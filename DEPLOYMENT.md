# Vivtron EVCS deployment

This branch contains the Laravel application source plus safe deployment templates.

## Setup

1. Copy `.env.example` to `.env` and set production values.
2. Generate the application key with `php artisan key:generate`.
3. Configure the production database and mail settings in `.env`.
4. Run `composer install --no-dev --optimize-autoloader`.
5. Run `php artisan migrate --force` and `php artisan storage:link`.
6. Run `php artisan config:cache`, `php artisan route:cache`, and `php artisan view:cache`.

Never commit `.env`, database dumps, credentials, backup archives, or private uploads.
