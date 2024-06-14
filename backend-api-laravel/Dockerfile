FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/brand-list-api/

# Install dependencies for the operating system software
RUN apk update && apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    zlib-dev \
    libzip-dev \
    oniguruma-dev \
    curl \
    git

# Clear cache
RUN rm -rf /var/cache/apk/*

# Install extensions for php
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents to the working directory
COPY  . /var/www/brand-list-api

# Copy environment file
COPY .env.example .env

EXPOSE 8000

CMD ["php-fpm"]

