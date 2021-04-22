FROM php:8.0-fpm

WORKDIR /backend

# Install modules
RUN apt-get update && apt-get install -y \
    openssl \
    curl \
    wget \
    git \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libicu-dev \
    libpq-dev \
            --no-install-recommends

RUN docker-php-ext-install intl exif pdo pdo_pgsql

CMD ["php-fpm", "-R"]
