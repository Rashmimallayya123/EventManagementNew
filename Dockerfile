FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod headers

# Copy project files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Apache config for .htaccess
RUN echo "<Directory /var/www/html/> \
    AllowOverride All \
    Require all granted \
</Directory>" > /etc/apache2/conf-available/allowoverride.conf \
    && a2enconf allowoverride

EXPOSE 80

CMD ["apache2-foreground"]
