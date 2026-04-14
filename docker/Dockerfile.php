FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    $PHPIZE_DEPS \
    curl \
    linux-headers \
    git \
    unzip \
    && docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del $PHPIZE_DEPS

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

COPY src/ /var/www/html/

COPY send.php /var/www/html/
COPY cache-user.php /var/www/html/

COPY queues/ /var/www/queues/

WORKDIR /var/www/html
RUN if [ -f composer.json ]; then composer install --no-dev --optimize-autoloader; fi

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
  CMD php-fpm -t || exit 1

EXPOSE 9000
CMD ["php-fpm"]