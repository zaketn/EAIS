FROM php:8.2-fpm-alpine

RUN apk upgrade --update
RUN apk add libsodium-dev
RUN apk add libzip-dev
RUN apk add libpng-dev

RUN docker-php-ext-install pdo pdo_mysql exif sodium zip gd

COPY --from=composer:2.3.7 /usr/bin/composer /usr/bin/composer
