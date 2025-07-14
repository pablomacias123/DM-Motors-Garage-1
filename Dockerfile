# Base oficial con Apache y PHP 8.1
FROM php:8.1-apache

# Copia todo tu proyecto al doc‑root de Apache
COPY . /var/www/html/

# Instala extensiones de PHP que usa tu app
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto HTTP
EXPOSE 80

# Arranque por defecto (ya definido por la imagen base)
