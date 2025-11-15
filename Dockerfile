FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod headers

# Add allowoverride config (correct quoting!)
RUN bash -c 'cat <<EOF > /etc/apache2/conf-available/allowoverride.conf
<Directory /var/www/html/>
    AllowOverride All
    Require all granted
</Directory>
EOF'

RUN a2enconf allowoverride

# Copy project
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
