FROM ghcr.io/eventpoints/php:main AS php

ENV APP_ENV="prod" \
    APP_DEBUG=0 \
    PHP_OPCACHE_PRELOAD="/app/config/preload.php" \
    PHP_EXPOSE_PHP="off" \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

# Remove xdebug configuration
RUN rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Create required directories
RUN mkdir -p var/cache var/log

# Copy dependency files
COPY composer.json composer.lock symfony.lock ./

# Install PHP dependencies
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# Copy application files and assets
COPY . /app
COPY package.json package-lock.json webpack.config.js ./
RUN npm install

# Build front-end assets
COPY assets ./assets
RUN npm run build

# Finalize PHP installation
RUN composer install --no-dev --no-interaction --classmap-authoritative
RUN composer symfony:dump-env prod
RUN chmod -R 777 var

FROM ghcr.io/eventpoints/caddy:main AS caddy

# Copy application files from the build stage
COPY --from=php /app/public public/
