# syntax=docker/dockerfile:1

FROM composer:lts as prod-deps
WORKDIR /app
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM composer:lts as dev-deps
WORKDIR /app
RUN --mount=type=bind,source=./composer.json,target=composer.json \
    --mount=type=bind,source=./composer.lock,target=composer.lock \
    --mount=type=cache,target=/tmp/cache \
    composer install --no-interaction

FROM php:8.2-apache as base
RUN a2enmod rewrite
RUN a2enmod headers

RUN docker-php-ext-install pdo pdo_mysql
COPY ./src/api /var/www/html/api

FROM base as development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY --from=dev-deps app/vendor/ /var/www/html/vendor

# In development, use config/.htaccess_dev as the .htaccess file
COPY config/.htaccess_dev /var/www/html/.htaccess

COPY config/000-default_dev.conf /etc/apache2/sites-available/000-default.conf

# Ensure the new configuration is enabled
RUN a2ensite 000-default.conf

# Stage 5: Build Vue.js for production
FROM node:18 AS frontend-build
WORKDIR /app
COPY src/frontend ./
RUN npm install
RUN npm run build

FROM base as final
COPY config/000-default_pro.conf /etc/apache2/sites-available/000-default.conf

# Ensure the new configuration is enabled
RUN a2ensite 000-default.conf

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --from=prod-deps app/vendor/ /var/www/html/vendor
COPY --from=frontend-build app/dist /var/www/html/frontend
USER www-data

# In production, use config/.htaccess_prod as the .htaccess file
COPY config/.htaccess_prod /var/www/html/.htaccess