FROM dunglas/frankenphp:php8.3

RUN install-php-extensions \
    pdo_mysql \
    intl \
    zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan optimize:clear

EXPOSE 8080

CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8080"]
