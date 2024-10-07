<?php

namespace App\Application\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\User\Infrastructure\Providers\UserInfrastructureServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(UserInfrastructureServiceProvider::class);
    }

    public function boot(): void {}
}
