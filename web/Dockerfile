# Use an official PHP image with Apache
FROM php:8.1-apache

# Set up environment and install necessary extensions
RUN echo "Setting up PHP"
RUN apt-get update && apt-get install -y libpq-dev git libzip-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy custom PHP configuration
COPY ./php-ini/php.prod.ini /usr/local/etc/php/php.ini

# Enable Apache CGI module and restart Apache
RUN a2enmod cgi
RUN service apache2 restart

# Ensure the src directory is not publicly accessible
# This should be managed in the docker-compose volumes section
# The COPY command for web files will be handled via docker-compose

# Set the document root to the pourpro folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/pourpro

# Update Apache config to use the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
