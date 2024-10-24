<?php

namespace App\BoundedContext\Authentication\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;
use App\BoundedContext\Authentication\Application\Command\LoginUserSession;
use App\BoundedContext\Authentication\Application\Command\LoginUserSessionHandler;
use App\BoundedContext\Authentication\Application\Command\LogoutUserSession;
use App\BoundedContext\Authentication\Application\Command\LogoutUserSessionHandler;
use App\BoundedContext\Authentication\Application\Command\PasswordReset;
use App\BoundedContext\Authentication\Application\Command\PasswordResetHandler;
use App\BoundedContext\Authentication\Application\Command\RequestPasswordReset;
use App\BoundedContext\Authentication\Application\Command\RequestPasswordResetHandler;
use App\BoundedContext\Authentication\Application\Query\GetUserAuthenticated;
use App\BoundedContext\Authentication\Application\Query\GetUserAuthenticatedHandler;

class AuthenticationCommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $commandBus = $this->app->make(CommandBusInterface::class);
        $queryBus = $this->app->make(QueryBusInterface::class);

        $commandBus->register(LoginUserSession::class, LoginUserSessionHandler::class);
        $commandBus->register(LogoutUserSession::class, LogoutUserSessionHandler::class);
        $commandBus->register(RequestPasswordReset::class, RequestPasswordResetHandler::class);
        $commandBus->register(PasswordReset::class, PasswordResetHandler::class);
        $queryBus->register(GetUserAuthenticated::class, GetUserAuthenticatedHandler::class);
    }

    public function boot(): void {}
}
