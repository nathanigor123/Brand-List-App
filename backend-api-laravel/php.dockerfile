FROM php:8.3-fpm-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

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

# Create a system group 'brandlistapi' with the specified GID
RUN addgroup -g 1001 --system brandlistapi

# Create a system user 'brandlistapi' with the specified UID, belonging to the 'brandlistapi' group
RUN adduser -G brandlistapi --system -D -s /bin/sh -u 1001 brandlistapi

# Update the PHP-FPM configuration file to use the 'brandlistapi' user and group
RUN sed -i "s/user = www-data/user = brandlistapi/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = brandlistapi/g" /usr/local/etc/php-fpm.d/www.conf

# Copy existing application directory contents to the working directory
COPY --chown=brandlistapi:brandlistapi . /var/www/brand-list-api

USER brandlistapi

EXPOSE 9000

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]

