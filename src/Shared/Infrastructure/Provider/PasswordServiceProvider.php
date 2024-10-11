<?php

namespace App\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Domain\Contract\PasswordServiceInterface;
use App\Shared\Infrastructure\Service\LaravelPasswordService;

class PasswordServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PasswordServiceInterface::class, LaravelPasswordService::class);
    }
}
