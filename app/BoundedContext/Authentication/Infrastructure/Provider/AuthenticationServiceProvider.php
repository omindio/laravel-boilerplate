<?php

namespace App\BoundedContext\Authentication\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;

use App\BoundedContext\Authentication\Application\Contract\AuthenticationNotificationServiceInterface;
use App\BoundedContext\Authentication\Application\Contract\AuthenticationSessionServiceInterface;
use App\BoundedContext\Authentication\Application\Contract\UserDatabaseMapperInterface;
use App\BoundedContext\Authentication\Domain\Contract\AuthenticationCommandRepositoryInterface;
use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent\EloquentAuthenticationCommandRepository;
use App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent\Mapper\EloquentUserDatabaseMapper;
use App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent\EloquentUserQueryRepository;
use App\BoundedContext\Authentication\Infrastructure\Service\LaravelAuthenticationNotificationService;
use App\BoundedContext\Authentication\Infrastructure\Service\LaravelAuthenticationSessionService;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserQueryRepositoryInterface::class, EloquentUserQueryRepository::class);
        $this->app->bind(UserDatabaseMapperInterface::class, EloquentUserDatabaseMapper::class);
        $this->app->bind(AuthenticationNotificationServiceInterface::class, LaravelAuthenticationNotificationService::class);
        $this->app->bind(AuthenticationCommandRepositoryInterface::class, EloquentAuthenticationCommandRepository::class);
        $this->app->bind(AuthenticationSessionServiceInterface::class, LaravelAuthenticationSessionService::class);
    }
}
