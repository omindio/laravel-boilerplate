<?php

namespace App\BoundedContext\Authorization\Infrastructure\Provider;

use App\BoundedContext\Authorization\Application\Command\CreateRole;
use App\BoundedContext\Authorization\Application\Command\CreateRoleHandler;
use App\BoundedContext\Authorization\Application\Command\DeleteRole;
use App\BoundedContext\Authorization\Application\Command\DeleteRoleHandler;
use App\BoundedContext\Authorization\Application\Command\UpdateRole;
use App\BoundedContext\Authorization\Application\Command\UpdateRoleHandler;
use Illuminate\Support\ServiceProvider;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;

class RoleCommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $commandBus = $this->app->make(CommandBusInterface::class);
        $queryBus = $this->app->make(QueryBusInterface::class);

        $commandBus->register(CreateRole::class, CreateRoleHandler::class);
        $commandBus->register(UpdateRole::class, UpdateRoleHandler::class);
        $commandBus->register(DeleteRole::class, DeleteRoleHandler::class);
    }

    public function boot(): void {}
}
