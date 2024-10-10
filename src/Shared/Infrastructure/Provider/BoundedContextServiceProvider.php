<?php

namespace App\Shared\Infrastructure\Provider;

use App\BoundedContext\User\Infrastructure\Provider\UserServiceProvider;
use Illuminate\Support\ServiceProvider;

class BoundedContextServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UserServiceProvider::class);
    }

    public function boot(): void {}
}
