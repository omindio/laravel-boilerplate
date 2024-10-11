<?php

namespace App\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Exception\GlobalExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;

class ExceptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExceptionHandler::class, GlobalExceptionHandler::class);
    }
}
