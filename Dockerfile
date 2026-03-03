FROM php:8.2-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir pasta de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Instalar dependências Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões
RUN chmod -R 775 storage bootstrap/cache

# Expor porta
EXPOSE 8000

# Rodar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000