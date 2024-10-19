<?php

namespace App\BoundedContext\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;
use App\BoundedContext\User\Application\Command\UpdateUserPasswordHandler;
use App\BoundedContext\User\Application\Command\UpdateUserPassword;
use App\BoundedContext\User\Application\Command\UpdateUserProfile;
use App\BoundedContext\User\Application\Command\UpdateUserProfileHandler;
use App\BoundedContext\User\Application\Query\GetUserProfile;
use App\BoundedContext\User\Application\Query\GetUserProfileHandler;

class UserCommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $commandBus = $this->app->make(CommandBusInterface::class);
        $queryBus = $this->app->make(QueryBusInterface::class);

        $commandBus->register(UpdateUserProfile::class, UpdateUserProfileHandler::class);
        $commandBus->register(UpdateUserPassword::class, UpdateUserPasswordHandler::class);
        $queryBus->register(GetUserProfile::class, GetUserProfileHandler::class);
    }

    public function boot(): void {}
}
