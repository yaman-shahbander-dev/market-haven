ARG PHP_EXTS="bcmath ctype fileinfo mbstring pdo pdo_mysql dom pcntl exif"
ARG PHP_PECL_EXTS="redis"

FROM composer:2.2 as composer_base

FROM php:8.2-cli as php_base
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer
ARG PHP_EXTS
ARG PHP_PECL_EXTS
RUN mkdir -p /var/www/html /var/www/html/bin
WORKDIR /var/www/html
RUN addgroup -S composer \
    && adduser -S composer -G composer \
    && chown -R composer /var/www/html \
    && apk add --virtual build-dependencies --no-cache \
       ${PHPIZE_DEPS} \
       openssl \
       ca-certificates \
       libxml2-dev \
       oniguruma-dev \
       autoconf \
       automake \
       libtool \
    && docker-php-ext-install -j$(nproc) ${PHP_EXTS} \
    && pecl install ${PHP_PECL_EXTS} \
    && docker-php-ext-enable ${PHP_PECL_EXTS} \
    && apk del build-dependencies

USER composer
COPY --chown=composer composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist
COPY --chown=composer . .
RUN composer install --no-dev --prefer-dist

FROM node:16 as frontend
COPY --from=composer_base /var/www/html /var/www/html
WORKDIR /var/www/html
RUN npm install && \
    npm run build

FROM php:8.2-alpine as cli
ARG PHP_EXTS
ARG PHP_PECL_EXTS

WORKDIR /var/www/html
RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} openssl ca-certificates libxml2-dev oniguruma-dev && \
    docker-php-ext-install -j$(nproc) ${PHP_EXTS} && \
    pecl install ${PHP_PECL_EXTS} && \
    docker-php-ext-enable ${PHP_PECL_EXTS} && \
    apk del build-dependencies
COPY --from=composer_base /var/www/html /var/www/html
COPY --from=frontend /var/www/html/public /var/www/html/public
RUN chown -R www-data:www-data /var/www/html
RUN chmod o+w /var/www/html -R


FROM php:8.2-fpm-alpine as fpm_server
ARG PHP_EXTS
ARG PHP_PECL_EXTS
WORKDIR /var/www/html
RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} openssl ca-certificates libxml2-dev oniguruma-dev && \
    docker-php-ext-install -j$(nproc) ${PHP_EXTS} && \
    pecl install ${PHP_PECL_EXTS} && \
    docker-php-ext-enable ${PHP_PECL_EXTS} && \
    apk del build-dependencies
USER www-data
COPY --from=composer_base --chown=www-data /var/www/html /var/www/html
COPY --from=frontend --chown=www-data /var/www/html/public /var/www/html/public
RUN php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache

FROM nginx:1.25-alpine as web_server
WORKDIR /var/www/html
COPY Docker/nginx.conf.template /etc/nginx/templates/default.conf.template
COPY --from=frontend /var/www/html/public /var/www/html/public

FROM cli as cron
WORKDIR /var/www/html
RUN touch laravel.cron && \
    echo "* * * * * cd /var/www/html && php artisan schedule:run" >> laravel.cron && \
    crontab laravel.cron
CMD ["crond", "-l", "2", "-f"]
FROM cli