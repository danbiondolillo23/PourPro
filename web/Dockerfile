FROM php:8.1-apache

# Install necessary packages
RUN echo "Setting up PHP" && \
    apt-get update && \
    apt-get install -y libpq-dev git libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pgsql pdo pdo_pgsql zip 

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy PHP configuration based on environment
COPY ./php-ini/php.prod.ini /usr/local/etc/php/php.ini

# Enable Apache modules
RUN a2enmod cgi && \
    a2enmod rewrite && \
    a2enmod vhost_alias

# Skip SSL in local environment
RUN if [ "$ENV" = "production" ]; then a2enmod ssl; fi

# Conditionally copy the appropriate vhost file
RUN if [ "$ENV" = "production" ]; then \
      cp ./vhosts.conf /etc/apache2/sites-available/000-default.conf; \
      a2ensite 000-default.conf; \
    else \
      cp ./vhosts.dev.conf /etc/apache2/sites-available/000-default.conf; \
      a2ensite 000-default.conf; \
    fi

# Copy application source files (including Composer files)
COPY ./src/ /opt/src/pourpro
COPY ./composer.json /opt/src/pourpro
COPY ./composer.lock /opt/src/pourpro

# Set permissions
RUN chown -R www-data:www-data /opt/src/pourpro && chmod -R 755 /opt/src/pourpro

# Set working directory to /opt/src/pourpro/ for Composer installation
WORKDIR /opt/src/pourpro

# Install Composer dependencies
RUN composer install --optimize-autoloader

RUN chown -R www-data:www-data /opt/src/pourpro/vendor

# Copy the web application files to the document root
COPY ./www /var/www/html

# Expose the port the container will listen on
EXPOSE 80
EXPOSE 443

# Start the Apache server in the foreground
CMD ["apache2-foreground"]
