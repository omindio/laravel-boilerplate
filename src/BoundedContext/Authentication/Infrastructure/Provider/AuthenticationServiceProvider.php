<?php

namespace App\BoundedContext\Authentication\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\BoundedContext\Authentication\Application\Contract\SessionAuthenticationInterface;
use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent\EloquentUserQueryRepository;
use App\BoundedContext\Authentication\Infrastructure\Service\LaravelSessionAuthenticationService;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserQueryRepositoryInterface::class, EloquentUserQueryRepository::class);
        $this->app->bind(SessionAuthenticationInterface::class, LaravelSessionAuthenticationService::class);
    }
}
