<?php

namespace App\Shared\Infrastructure\Provider;

use App\BoundedContext\User\Infrastructure\Provider\UserServiceProvider;
use App\BoundedContext\Authentication\Infrastructure\Provider\AuthenticationServiceProvider;
use App\BoundedContext\Authorization\Infrastructure\Provider\AuthorizationServiceProvider;
use Illuminate\Support\ServiceProvider;

class BoundedContextServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(AuthenticationServiceProvider::class);
        $this->app->register(AuthorizationServiceProvider::class);
    }

    public function boot(): void {}
}
