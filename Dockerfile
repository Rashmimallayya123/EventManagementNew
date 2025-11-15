# Use official PHP-Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN bash -c 'cat > /etc/apache2/conf-available/allowoverride.conf <<EOF
<Directory /var/www/html/>
    AllowOverride All
</Directory>
EOF'

RUN a2enconf allowoverride

# Copy project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
