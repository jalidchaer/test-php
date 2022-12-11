
#Test PHP

Pasos para ejecutar el test

1. Ejecutar el comando ```composer update```

2. Ejecutar el comando ```composer dump-autoload -o```

3. Crear una base de datos con el nombre db_test

5. Clonar el archivo ```.env.template``` y renombrarlo a ```.env```

6. Ejecutar la migración con el comando ```phinx-migrate```

7. Para el test ejecutar el comando ```run-tests```


Para resetear la base de datos ejecutar el comando ```phinx-rollback```

Para crear una nueva migración ejecutar el comando ```

Para levantar el servidor ejecutar el comando ```php -S localhost:8080```