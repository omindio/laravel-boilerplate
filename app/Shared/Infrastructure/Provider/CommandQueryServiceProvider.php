<?php

namespace App\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\BoundedContext\User\Infrastructure\Provider\UserCommandQueryServiceProvider;
use App\BoundedContext\Authentication\Infrastructure\Provider\AuthenticationCommandQueryServiceProvider;
use App\BoundedContext\Authorization\Infrastructure\Provider\PermissionCommandQueryServiceProvider;
use App\BoundedContext\Authorization\Infrastructure\Provider\RoleCommandQueryServiceProvider;
use App\Shared\Infrastructure\Bus\CommandBus;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Infrastructure\Bus\QueryBus;
use App\Shared\Infrastructure\Bus\CommandHandlerLocator;
use App\Shared\Infrastructure\Bus\QueryHandlerLocator;
use App\Shared\Infrastructure\Bus\HandlerInflector;
use App\Shared\Infrastructure\Bus\Middleware\TransactionMiddleware;
use App\Shared\Application\Contract\QueryBusInterface;
use App\Shared\Application\Contract\TransactionManagerInterface;

class CommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->singleton(CommandHandlerLocator::class, function ($app) {
            return new CommandHandlerLocator($app);
        });

        $this->app->singleton(CommandBusInterface::class, function ($app) {
            $locator = $app->make(CommandHandlerLocator::class);
            $inflector = new HandlerInflector();

            $commandBus = new CommandBus($locator, $inflector);


            $transactionMiddleware = new TransactionMiddleware(
                $app->make(TransactionManagerInterface::class)
            );

            $commandBus->addMiddleware($transactionMiddleware);

            return $commandBus;
        });

        $this->app->singleton(QueryHandlerLocator::class, function ($app) {
            return new QueryHandlerLocator($app);
        });

        $this->app->singleton(QueryBusInterface::class, function ($app) {
            $locator = $app->make(QueryHandlerLocator::class);
            $inflector = new HandlerInflector();

            $queryBus = new QueryBus($locator, $inflector);

            return $queryBus;
        });

        $this->registerContexts();
    }

    private function registerContexts(): void
    {
        $this->app->register(UserCommandQueryServiceProvider::class);
        $this->app->register(AuthenticationCommandQueryServiceProvider::class);
        $this->app->register(RoleCommandQueryServiceProvider::class);
        $this->app->register(PermissionCommandQueryServiceProvider::class);
    }

    public function boot(): void {}
}
