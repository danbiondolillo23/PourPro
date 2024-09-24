FROM php:8.1-apache

RUN echo "Setting up PHP"

# Install necessary packages
RUN apt-get update && apt-get install -y libpq-dev git libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pgsql pdo pdo_pgsql zip 

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy PHP configuration
COPY ./php-ini/php.prod.ini /usr/local/etc/php/php.ini

# Enable Apache modules
RUN a2enmod cgi
RUN a2enmod rewrite
RUN a2enmod vhost_alias
RUN a2enmod ssl

# Copy custom vhost file
COPY ./vhosts.conf /etc/apache2/sites-available/000-default.conf

# Enable the custom virtual host
RUN a2ensite 000-default.conf

# Ensure destination directory exists
RUN mkdir -p /opt/src/pourpro/frontend

# Copy application source files (including Composer files)
COPY ./src/PourPro/ /opt/src/pourpro/PourPro
COPY ./composer.json /opt/src/pourpro/PourPro
COPY ./composer.lock /opt/src/pourpro/PourPro

# Set working directory to /opt/src/pourpro/PourPro for Composer installation
WORKDIR /opt/src/pourpro/PourPro

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /opt/src/pourpro && chmod -R 755 /opt/src/pourpro

# Ensure destination directory exists
RUN mkdir -p /var/www/html/pourpro

# Copy the web application files to the document root
COPY ./www /var/www/html

# Expose the port the container will listen on
EXPOSE 80
EXPOSE 443

# Start the Apache server in the foreground
CMD ["apache2-foreground"]
