FROM php:7.4-fpm-alpine

WORKDIR /backend

RUN set -xe \
    && apk add --no-cache --update zlib libxml2-dev libzip-dev fcgi \
    && pecl channel-update pecl.php.net \
    # common
    && docker-php-ext-install zip intl xsl gd openssl sodium \
    # opcache
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache \
    # pgsql
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql pgsql
CMD ["php-fpm", "-R"]
