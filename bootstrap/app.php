<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
//use App\Domains\Auth\Http\Middlewares\CustomBasicAuthMiddleware;

//TODO: Revisar añadir un error 500 si no hay condicion de excepcion
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../app/Infrastructure/Routes/api.php',
        apiPrefix: '/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        require_once __DIR__ . '/../app/Infrastructure/Http/Middlewares/middleware.php';
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //TODO: Revisar en pruebas reales si estas excepciones son las correctas y devuelven los mensajes correctos
        require_once __DIR__ . '/../app/Infrastructure/Exceptions/exceptions.php';
    })->create();
