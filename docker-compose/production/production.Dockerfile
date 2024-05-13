FROM php:7.4-fpm-alpine

RUN apk add npm git

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN chmod -R 777 /var/www/storage
# RUN composer install
# RUN npm install
# RUN npm run production
# RUN php artisan key:generate