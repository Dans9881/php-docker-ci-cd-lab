FROM php:8.3-fpm

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-install pdo pdo_mysql mysqli