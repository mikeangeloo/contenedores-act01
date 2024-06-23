# Especificamos la imagen de apache a utilizar
FROM php:8.3.7-apache

# Establecemos el directorio de trabajo
WORKDIR /var/www/html

# Copiamos los ficheros de la carpeta src a la carpeta del contenedor que expone los aplicativos
COPY ./project /var/www/html

# Exponemos el puerto
EXPOSE 9001

# Actualizamos apache para que escuche el puerto: 9001
RUN sed -i 's/Listen 80/Listen 9001/' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:9001>/' /etc/apache2/sites-available/000-default.conf

# Inicializamos apache en segundo plano
CMD ["apache2-foreground"]
