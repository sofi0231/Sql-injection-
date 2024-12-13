FROM php:7.4-apache
RUN apt-get update -y

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

# Aggiungo i permessi alla cartella 
RUN chown -R www-data:www-data /var/www/

COPY . /var/www/html/