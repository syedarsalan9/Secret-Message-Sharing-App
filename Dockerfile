# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install dependencies required for composer and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to the web root
WORKDIR /var/www/html

# Copy the application code first
COPY . .

# Ensure the artisan file has executable permissions
RUN chmod +x /var/www/html/artisan

# Now install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Give write permission to Apache for the files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Expose port 8080 to be accessible
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]
