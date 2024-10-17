<?php

namespace App\BoundedContext\User\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;
use App\BoundedContext\User\Application\Command\UpdateUserPasswordHandler;
use App\BoundedContext\User\Application\Command\UpdateUserPassword;

class UserCommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $commandBus = $this->app->make(CommandBusInterface::class);
        $queryBus = $this->app->make(QueryBusInterface::class);

        $commandBus->register(UpdateUserPassword::class, UpdateUserPasswordHandler::class);
    }

    public function boot(): void {}
}
