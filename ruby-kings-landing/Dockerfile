# Especificamos la imagen de ruby a utilizar
FROM ruby:2.7.4

# throw errors if Gemfile has been modified since Gemfile.lock
RUN bundle config --global frozen 1

# Establecemos el directorio de trabajo
WORKDIR /usr/src/app

# Copiamos los ficheros de la carpeta src a la carpeta del contenedor que expone los aplicativos
COPY ./proyect/Gemfile ./src/Gemfile.lock ./
# RUN gem install bundler -v 2.0
RUN bundle install

COPY ./project .

RUN cp config.example.yml config.yml

# Exponemos el puerto
EXPOSE 9002

# Inicializamos apache en segundo plano
CMD ["foreman", "start"]