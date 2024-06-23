#!/bin/sh

# Máximo número de intentos
max_attempts=10
attempts=0

# Esperar hasta que la base de datos esté disponible o alcanzar el límite de intentos
while ! nc -z db 3306; do
  attempts=$((attempts+1))
  if [ $attempts -ge $max_attempts ]; then
    echo "No se pudo conectar a la base de datos después de varios intentos, saliendo."
    exit 1
  fi
  echo "Esperando a que la base de datos esté disponible... Intento $attempts/$max_attempts"
  sleep 1
done


# Verificar si la carpeta vendor existe
if [ ! -d "vendor" ]; then
  echo "La carpeta vendor no existe, ejecutando composer install."
  
  #Ejecutamos composer update
  composer update

  #Ejecutamos composer install para que haga la carpeta vendor
  composer install
else
  echo "La carpeta vendor ya existe, saltando composer install."
fi

php artisan cache:clear

php artisan view:clear

# Verificar si la tabla 'migrations' existe en la base de datos
verificar_migracion() {
  php -r '
    $pdo = new PDO("mysql:host=db;dbname=laravel", "laravel", "laravel_password");
    $result = $pdo->query("SELECT 1 FROM migrations LIMIT 1");
    if ($result !== false) {
        echo "La tabla 'migrations' existe en la base de datos." . PHP_EOL;
    } else {
        echo "La tabla 'migrations' no existe en la base de datos." . PHP_EOL;
        passthru("php artisan migrate");
        passthru("php artisan db:seed");
    }
'
}
verificar_migracion


#---------------------------- APACHE 

# Máximo número de intentos para reiniciar Apache
max_apache_restarts=3
apache_attempts=0

# Función para reiniciar Apache
restart_apache() {
  echo "Intento de reiniciar Apache..."
  apache2ctl graceful
}

# Función para verificar y reiniciar Apache si es necesario
check_and_restart_apache() {
  # Verificar si Apache está en ejecución
  if apache2ctl configtest; then
    echo "Apache está funcionando correctamente."
  else
    echo "¡Error! Configuración de Apache incorrecta. Intentando reiniciar Apache..."
    restart_apache
    apache_attempts=$((apache_attempts+1))
    if [ $apache_attempts -ge $max_apache_restarts ]; then
      echo "No se pudo reiniciar Apache después de $max_apache_restarts intentos. Deteniendo el contenedor."
      exit 1
    fi
    sleep 2
    check_and_restart_apache
  fi
}

# Ejecutamos Verificar y reiniciar Apache
check_and_restart_apache

# Mantener el contenedor en ejecución
echo "Iniciando Apache en primer plano..."
exec apache2-foreground






