FROM php:8.2-apache

# Install mysqli and pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Allow .htaccess and enable PHP execution in all dirs
RUN printf "<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Options Indexes FollowSymLinks\n\
    Require all granted\n\
</Directory>\n" > /etc/apache2/conf-available/override.conf \
    && a2enconf override

# Copy project files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
