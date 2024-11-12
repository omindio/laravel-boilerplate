<?php

namespace App\BoundedContext\Authorization\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;

class PermissionCommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $commandBus = $this->app->make(CommandBusInterface::class);
        $queryBus = $this->app->make(QueryBusInterface::class);

        //$commandBus->register(AddRole::class, AddRoleHandler::class);
    }

    public function boot(): void {}
}
