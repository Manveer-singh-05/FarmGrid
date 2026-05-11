# Lightweight PHP 8.2 Alpine image
FROM php:8.2-cli-alpine

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    unzip \
    zip \
    nodejs \
    npm \
    libzip-dev \
    oniguruma-dev \
    autoconf \
    g++ \
    make \
    openssl-dev

# Install required PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip

# Install MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Install frontend dependencies and build assets
RUN npm install && npm run build

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Create storage symlink
RUN php artisan storage:link || true

# Expose Render port
EXPOSE 10000

# Start Laravel server
CMD sh -c "php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=10000"