# Imagen base con PHP + Apache
FROM php:8.2-apache

# Habilita mod_rewrite y extensiones necesarias
RUN a2enmod rewrite && \
    docker-php-ext-install mysqli pdo pdo_mysql

# Copia tu proyecto al contenedor
COPY . /var/www/html/

# Cambia la raíz del sitio a la carpeta public/
WORKDIR /var/www/html/public

# Configura permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Configura Apache para CodeIgniter
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n\
DocumentRoot /var/www/html/public' > /etc/apache2/sites-available/000-default.conf

EXPOSE 80

# Inicia Apache
CMD ["apache2-foreground"]
