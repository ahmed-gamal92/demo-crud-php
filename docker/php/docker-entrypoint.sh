#!/bin/sh
set -ex

# Copy project and .env
rsync -arv --exclude=create-env-file.sh --exclude=docker /var/www_original/* /var/www/
cp /var/www_original/.env /var/www/

# Permissions
chown -R www-data /var/www
cd /var/www
chgrp -R www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

# Run migrations
# php artisan migrate --force

exec "$@"