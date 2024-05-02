#!/bin/sh
rm -rf vendor composer.lock
composer install --ignore-platform-req=ext-zip
npm install
npm run production
php artisan key:generate
php artisan migrate
php artisan db:seed