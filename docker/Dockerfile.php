FROM php:8.3-fpm-alpine

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

COPY src/ /var/www/html

RUN chown -R www-data:www-data /var/www/html

HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
 CMD php-fpm -t || exit 1

EXPOSE 9000

CMD ["php-fpm"]