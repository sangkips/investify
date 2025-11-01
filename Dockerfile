# # Build stage for Node.js
# FROM node:18 as node-builder
# WORKDIR /app
# COPY package*.json ./
# RUN npm install
# COPY . .
# RUN npm run build


# FROM php:8.2-fpm

# # Install system dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip \
#     libzip-dev

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# # Install PHP extensions
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# # Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Set working directory
# WORKDIR /var/www

# # Copy existing application directory
# COPY . .

# # Copy built assets from node stage
# COPY --from=node-builder /app/public/build /var/www/public/build

# # Install dependencies
# RUN composer install --no-dev --optimize-autoloader

# # Set permissions
# RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
# RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# # Cache configuration
# RUN php artisan config:cache && \
#     php artisan route:cache && \
#     php artisan view:cache


# EXPOSE 9000
# CMD ["php-fpm"]

# Stage 1: Composer - Dependency Installation
FROM composer:2.7 AS vendor

WORKDIR /app

# Copy only the files needed for dependency installation for optimal layer caching
COPY database/ database/
COPY composer.json composer.lock ./

# Install dependencies without dev dependencies for a production build
# --ignore-platform-req=ext-* is often needed in multi-stage builds to bypass local system checks
RUN composer install \
    --no-dev \
    --ignore-platform-req=ext-* \
    --optimize-autoloader \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --no-cache

# Stage 2: Node - Frontend Asset Build (if you use Vite/Webpack)
FROM node:20-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json* ./
COPY vite.config.js ./
COPY resources/ ./resources/

RUN npm ci && npm run build

# Stage 3: PHP FPM - Production Runtime
FROM php:8.2-fpm-alpine AS application

# Security Best Practice: Run as a non-root user
RUN addgroup -g 1000 laravel && adduser -u 1000 -G laravel -s /bin/sh -D laravel

# Install system dependencies that need to stay
RUN apk add --no-cache \
        postgresql-client \
        libpng \
        libzip \
        oniguruma \
        libpq \
        freetype \
        libjpeg-turbo

# Install build dependencies
RUN apk add --no-cache --virtual .build-deps \
        postgresql-dev \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        freetype-dev \
        libjpeg-turbo-dev \
        $PHPIZE_DEPS

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        pgsql \
        pcntl \
        gd \
        zip \
        mbstring \
        bcmath \
        exif

# Clean up build dependencies
RUN apk del --no-cache .build-deps

# Use the production PHP configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# You can also copy a custom php.ini file here for further tuning
# COPY docker/php.ini $PHP_INI_DIR/conf.d/

WORKDIR /var/www/html

# Copy the composer dependencies from the vendor stage
COPY --from=vendor /app/vendor/ ./vendor/
# Copy the built assets from the assets stage
COPY --from=assets /app/public/build/ ./public/build/

# Copy application code
COPY --chown=laravel:laravel . .

# Create necessary directories and set permissions
RUN mkdir -p /var/www/html/storage/logs \
             /var/www/html/storage/framework/cache \
             /var/www/html/storage/framework/sessions \
             /var/www/html/storage/framework/views \
             /var/www/html/bootstrap/cache \
    && chown -R laravel:laravel \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
    && chmod -R 775 \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache

# Switch to the non-root user
USER laravel

# Health check (can be overridden by Kubernetes probes)
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

# This CMD uses the fpm image's default command, which is correct.
# It is best practice to let the base image handle the default command.

EXPOSE 9000
CMD ["php-fpm"]