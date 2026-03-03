# ---------- STAGE 1: BUILD FRONTEND ----------
FROM node:20 AS node_builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# ---------- STAGE 2: PHP + NGINX ----------
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    unzip \
    nginx \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Copiar build do Vite do stage anterior
COPY --from=node_builder /app/public/build /var/www/public/build

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/nginx.conf

EXPOSE 10000

CMD php artisan config:clear && \
    php artisan migrate --force && \
    service nginx start && \
    php-fpm