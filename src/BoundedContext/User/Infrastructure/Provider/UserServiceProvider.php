<?php

namespace App\BoundedContext\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\BoundedContext\User\Infrastructure\Persistence\Eloquent\EloquentUserCommandRepository;
use App\BoundedContext\User\Infrastructure\Persistence\Eloquent\EloquentUserQueryRepository;

use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;

use App\BoundedContext\User\Domain\Contract\UserPasswordServiceInterface;

use App\BoundedContext\User\Infrastucture\Service\LaravelHashPasswordService;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserCommandRepositoryInterface::class, EloquentUserCommandRepository::class);
        $this->app->bind(UserQueryRepositoryInterface::class, EloquentUserQueryRepository::class);

        $this->app->singleton(UserPasswordServiceInterface::class, LaravelHashPasswordService::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Infrastructure/Persistence/Eloquent/Migration');
    }
}
