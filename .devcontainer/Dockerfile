# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli pdo_mysql

# Habilitar el módulo de reescritura de Apache (opcional, pero útil)
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html