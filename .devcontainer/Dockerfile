# Stage 1: Builder
# Esta etapa constroi as dependencias Composer e NPM
FROM php:8.0-fpm as builder

# Instala dependencias do sistema, incluindo Node.js e npm
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Instala extensoes PHP necessarias
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd mbstring

# Pega o Composer mais recente
COPY --from=composer/latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia o codigo e executa o build (o '..' se refere a pasta raiz do projeto)
COPY .. /var/www/html 

# Instala dependencias Composer e NPM, e constroi assets (Tailwind/Bootstrap)
RUN composer install --no-interaction --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Stage 2: Final Runtime Image
# Imagem final, otimizada para execucao com PHP 8.0
FROM php:8.0-fpm

WORKDIR /var/www/html

# Instala apenas as extensoes PHP necessarias para o runtime
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd mbstring

# Copia o codigo e os artefatos (incluindo vendor/ e assets compilados) da etapa de build
COPY --from=builder /var/www/html /var/www/html

# Define permissoes para storage e cache do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]