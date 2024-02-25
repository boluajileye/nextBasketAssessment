FROM php:8.1-apache

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY ../UserService /var/www/html

COPY ../docker/apache/UserService/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default.conf

CMD ["apache2-foreground"]

COPY ../UserService/.env.example /var/www/html/.env