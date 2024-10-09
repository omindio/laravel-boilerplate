<?php

namespace App\Shared\Provider;

use Illuminate\Support\ServiceProvider;

class BoundedContextServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(\App\BoundedContext\User\Infrastructure\Provider\UserServiceProvider::class);
    }

    public function boot(): void {}
}
