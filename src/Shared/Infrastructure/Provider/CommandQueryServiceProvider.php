<?php

namespace App\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\BoundedContext\User\Infrastructure\Provider\UserCommandQueryServiceProvider;
use App\BoundedContext\Authentication\Infrastructure\Provider\AuthenticationCommandQueryServiceProvider;
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
        $this->app->singleton(CommandBusInterface::class, function ($app) {
            $handlerLocator = new CommandHandlerLocator();
            $handlerInflector = new HandlerInflector();

            $commandBus = new CommandBus($handlerLocator, $handlerInflector);

            $transactionMiddleware = new TransactionMiddleware(
                $app->make(TransactionManagerInterface::class)
            );

            $commandBus->addMiddleware($transactionMiddleware);

            return $commandBus;
        });

        $this->app->singleton(QueryBusInterface::class, function ($app) {
            $handlerLocator = new QueryHandlerLocator();
            $handlerInflector = new HandlerInflector();

            $queryBus = new QueryBus($handlerLocator, $handlerInflector);

            return $queryBus;
        });

        $this->registerContexts();
    }

    private function registerContexts(): void
    {
        $this->app->register(UserCommandQueryServiceProvider::class);
        $this->app->register(AuthenticationCommandQueryServiceProvider::class);
    }

    public function boot(): void {}
}
