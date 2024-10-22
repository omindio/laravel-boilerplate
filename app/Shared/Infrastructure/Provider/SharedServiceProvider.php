<?php

namespace App\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Infrastructure\Provider\RateLimiterServiceProvider;
use App\Shared\Infrastructure\Provider\PasswordServiceProvider;
use App\Shared\Infrastructure\Provider\TransactionServiceProvider;
use App\Shared\Infrastructure\Provider\BoundedContextServiceProvider;
use App\Shared\Infrastructure\Provider\CommandQueryServiceProvider;
use App\Shared\Infrastructure\Provider\ExceptionServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RateLimiterServiceProvider::class);
        $this->app->register(PasswordServiceProvider::class);
        $this->app->register(CaptchaServiceProvider::class);
        $this->app->register(TransactionServiceProvider::class);
        $this->app->register(BoundedContextServiceProvider::class);
        $this->app->register(CommandQueryServiceProvider::class);
        $this->app->register(ExceptionServiceProvider::class);
    }

    public function boot(): void
    {
        //$this->loadMigrationsFrom(__DIR__ . '/../../Infrastructure/Persistence/Eloquent/Migration');
    }
}
