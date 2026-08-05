FROM php:8.2-apache

# Install required system dependencies and extensions for CI4
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql zip mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Change Apache document root to CI4 public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Copy project files
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Set permissions for writable directory
RUN chown -R www-data:www-data /var/www/html/writable

EXPOSE 80