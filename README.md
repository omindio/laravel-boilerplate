## Configurar .env

-   Copiar .env.example y crear un nuevo .env con las variables correctas.
-   Configura las variables para la conexión en la database:

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secret

## Configurar vscode

-   Create file settings.json inside .vscode folder on rooth path and add next code:

{
"php.validate.executablePath": "/usr/local/bin/php",
"intelephense.environment.phpExecutable": "/usr/local/bin/php"
}

## Levantar contenedores

-   docker-compose up -d --build

## Comandos de ayuda

-   docker exec -it laravel-app bash
-   docker-compose down
-   php artisan config:clear
-   php artisan config:cache
-   php artisan route:clear
-   php artisan route:cache
