FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod php8.2

# Set recommended PHP.ini settings
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Configure Apache to allow .htaccess and allow PHP in all subfolders
RUN echo '<Directory /var/www/html/>' > /etc/apache2/conf-available/override.conf \
    && echo '    AllowOverride All' >> /etc/apache2/conf-available/override.conf \
    && echo '    Options Indexes FollowSymLinks' >> /etc/apache2/conf-available/override.conf \
    && echo '    Require all granted' >> /etc/apache2/conf-available/override.conf \
    && echo '</Directory>' >> /etc/apache2/conf-available/override.conf

RUN a2enconf override

# Copy project files
COPY . /var/www/html/

# Fix file permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
