## Configurar .env

-   Copiar .env.example y crear un nuevo .env con las variables correctas.
-   Configura las variables para la conexión en la database:

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secret

## Levantar contenedores

-   docker-compose up -d --build

-   docker exec -it laravel-app bash
