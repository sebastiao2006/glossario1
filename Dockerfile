# 1. Base PHP com FPM
FROM php:8.2-fpm

# 2. Instala pacotes do sistema
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

# 5. Copia os arquivos do projeto
COPY . .

# 6. Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# 7. Cache para produção
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 8. Expõe a porta do Laravel
EXPOSE 8000

# 9. Comando para iniciar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000