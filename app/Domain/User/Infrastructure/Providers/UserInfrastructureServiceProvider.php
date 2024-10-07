<?php

namespace App\Domain\User\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\User\Infrastructure\Repositories\UserRepository;
use App\Domain\User\Domain\Repositories\UserRepositoryInterface;
use App\Domain\User\Domain\Interfaces\PasswordServiceInterface;
use App\Domain\User\Infrastucture\Services\PasswordService;

class UserInfrastructureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PasswordServiceInterface::class, PasswordService::class);
    }

    public function boot(): void {}
}
