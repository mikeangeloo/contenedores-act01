# Usar la imagen oficial de PHP con Apache compatible con arm64
FROM php:5.6.40-apache

# Cambiar las fuentes de los repositorios a los archivos de Debian
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list && \
    sed -i '/security.debian.org/d' /etc/apt/sources.list && \
    sed -i '/stretch-updates/d' /etc/apt/sources.list && \
    echo "deb http://archive.debian.org/debian stretch main contrib non-free" > /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until

# Movemos nuestro archivo de conf del vhost a la carpeta del contendor para sobreescribir
COPY ./config/vhost.conf /etc/apache2/sites-available/000-default.conf

# Establecemos el directorio de trabajo
WORKDIR /var/www/html

# Instalamos extensiones de PHP necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    zip \
    unzip \
    netcat \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql mbstring

# Instalamos Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiamos el contenido del proyecto a la imagen
COPY ./project /var/www/html

# Establecemos la variable de entorno para permitir superusuario en Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Establecemos permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponemos el puerto 80
EXPOSE 80

# Configuración de Apache
RUN a2enmod rewrite

# Definir el script de entrada por defecto
ENTRYPOINT ["sh", "/var/www/html/commands/post-commands.sh"]