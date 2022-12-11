
#Test PHP

Pasos para ejecutar el test

1. Ejecutar el comando ```composer update```

2. Ejecutar el comando ```composer dump-autoload -o```

3. Crear una base de datos con el nombre db_test

5. Clonar el archivo ```.env.template``` y renombrarlo a ```.env```

6. Ejecutar la migración con el comando ```composer phinx-migrate```

7. Para el test ejecutar el comando ```composer run-tests```

Para crear una nueva migración ejecutar el comando ```composer phinx-create```

Para levantar el servidor para el uso de la API ejecutar el comando ```php -S localhost:8080```

STACK UTILIZADO 

XAMPP

versión de PHP 7.4.29
