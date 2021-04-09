FROM php:8.0-fpm-alpine

WORKDIR /backend

RUN set -xe apk add --no-cache --update zlib libxml2-dev libzip-dev fcgi \
RUN apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
RUN pecl channel-update pecl.php.net \
# common
RUN docker-php-ext-install zip intl \
# opcache
RUN docker-php-ext-configure opcache --enable-opcache \
RUN docker-php-ext-install opcache \
# pgsql
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql pgsql

CMD ["php-fpm", "-R"]
