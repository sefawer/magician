# Use an official PHP image with PHP-FPM
FROM php:8.4.1-fpm

# Set environment variables
ENV APP_DIR=/var/www/html

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nginx \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt-get clean

# Copy Laravel project to the container
COPY . $APP_DIR

# Set working directory
WORKDIR $APP_DIR

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-enabled/default

# Copy supervisord configuration
COPY supervisord.conf /etc/supervisord.conf

# Expose necessary ports
EXPOSE 80
EXPOSE 3306
#EXPOSE 9000

# Start supervisord to manage Nginx and PHP-FPM
CMD ["supervisord", "-c", "/etc/supervisord.conf"]