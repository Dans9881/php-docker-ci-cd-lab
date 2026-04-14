FROM php:8.3-fpm-alpine

# Install dependencies + PHP extensions
RUN apk add --no-cache $PHPIZE_DEPS curl linux-headers \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

# Copy source code
COPY . /var/www/html

# Set permission
RUN chown -R www-data:www-data /var/www/html

# Install PHP dependencies (kalau ada composer.json)
RUN composer install || true

# Healthcheck
HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
 CMD php-fpm -t || exit 1

EXPOSE 9000

CMD ["php-fpm"]