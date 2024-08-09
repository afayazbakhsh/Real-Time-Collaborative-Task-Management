# Use an official PHP image from the Docker Hub
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www

# Copy the local application code into the container
COPY . /var/www

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Copy custom configuration files (e.g., php.ini)
COPY ./docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
