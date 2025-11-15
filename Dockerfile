FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable rewrite module
RUN a2enmod rewrite

# Copy Apache override config
COPY apache.conf /etc/apache2/conf-available/allowoverride.conf
RUN a2enconf allowoverride

# Copy project files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
