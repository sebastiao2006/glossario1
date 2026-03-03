FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    nginx \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Copiar configuração do Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

EXPOSE 10000

CMD service nginx start && php-fpm