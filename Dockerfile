# Stage 1: Builder
# This stage installs both Composer and NPM dependencies and builds the frontend assets.
FROM php:8.2-fpm as builder

# Install system dependencies, including Node.js and npm
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
    npm

# Install PHP extensions required for Composer and building
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd mbstring

# Get latest Composer
COPY --from=composer/latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy dependency definition files
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# Install Composer dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Install NPM dependencies
RUN npm install

# Copy the rest of the application code
COPY . .

# Build frontend assets
RUN npm run build

# Clean up node_modules to keep the final image smaller
RUN rm -rf node_modules

# Stage 2: Final Runtime Image
# This stage creates the final, optimized image for execution.
FROM php:8.2-fpm

WORKDIR /var/www/html

# Install only the required PHP extensions for Laravel runtime
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd mbstring

# Copy application code and built artifacts from the builder stage
COPY --from=builder /app /var/www/html

# Set correct permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
