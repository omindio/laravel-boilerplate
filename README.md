# Installation

> [!IMPORTANT]
> Be sure you have installed _docker_ and _vscode_.

## 1. Configure .env variables

-   Copy **.env.example** and create new **.env** file with the correct variable values.
-   Pay atention on next variables:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secret

SESSION_DRIVER=redis

FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis

CACHE_STORE=redis

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## 2. Configure vscode

-   Install next extensions: **PHP Intelephense**
-   Create file **settings.json** inside **.vscode** folder on root path and add next code:

```
{
    "php.validate.executablePath": "/usr/local/bin/php",
    "intelephense.environment.phpExecutable": "/usr/local/bin/php"
}
```

## 3. Run containers & install dependencies

```
docker-compose up -d --build
docker exec -it laravel-app bash
composer install
```

Api endpoint: http://localhost:8080

## 4. Run migrations

```
php artisan migrate
```

## 5. Generate api documentation (Swagger)

```
php artisan l5-swagger:generate
```

You can see api documentation on http://localhost:8080/docs

## 6. Help commands

```
docker-compose down
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache
```
