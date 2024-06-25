# Especificamos la imagen de ruby a utilizar
FROM ruby:2.7.4

# Para que arroje errores si Gemfile ha sido modificado desde Gemfile.lock
RUN bundle config --global frozen 1

# Establecemos el directorio de trabajo
WORKDIR /usr/src/app

# Copiamos los ficheros de la carpeta project a la carpeta del contenedor que expone los aplicativos
COPY ./project/Gemfile ./project/Gemfile.lock ./

# Construimos la aplicación
RUN bundle install

# Copiamos todo el projecto al directorio de trabajo
COPY ./project .

# Creamos el archivo config.yml a partir de config.example.yml
RUN cp config.example.yml config.yml

# Exponemos el puerto 9002
# El puerto tambien se configuro en: ruby-kings-landing/project/Procfile
EXPOSE 9002

# Inicializamos foreman en segundo plano, este se instala apartir de las dependencias definidas en el Gemfile file
CMD ["foreman", "start"]