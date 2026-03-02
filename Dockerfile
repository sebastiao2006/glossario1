# 1. Base PHP CLI (não FPM)
FROM php:8.2-cli

# 2. Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql zip

# 3. Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Diretório de trabalho
WORKDIR /var/www/html

# 5. Copia projeto
COPY . .

# 6. Instala dependências
RUN composer install --no-dev --optimize-autoloader

# 7. Permissões
RUN chmod -R 777 storage bootstrap/cache

# 8. Expõe porta padrão do Render
EXPOSE 10000

# 9. Inicia usando variável PORT do Render
CMD php artisan serve --host=0.0.0.0 --port=${PORT}