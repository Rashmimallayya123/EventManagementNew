FROM php:8.1-apache

# Enable Apache mod_rewrite (needed for PHP routing & .htaccess)
RUN a2enmod rewrite

# Copy project files into Apache root
COPY . /var/www/html/

# Basic permissions
RUN chmod -R 755 /var/www/html/
