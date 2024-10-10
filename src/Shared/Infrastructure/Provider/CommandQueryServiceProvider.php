<?php

namespace App\Shared\Infrastructure\Provider;

use Illuminate\Support\ServiceProvider;
use App\BoundedContext\User\Application\Command\UpdateUserPasswordHandler;
use App\BoundedContext\User\Application\Command\UpdateUserPassword;
use App\Shared\Application\Bus\CommandBus;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Bus\QueryBus;
use App\Shared\Application\Bus\CommandHandlerLocator;
use App\Shared\Application\Bus\QueryHandlerLocator;
use App\Shared\Application\Bus\HandlerInflector;
use App\Shared\Application\Bus\Middleware\TransactionMiddleware;
use App\Shared\Application\Contract\QueryBusInterface;
use App\Shared\Application\Contract\TransactionManagerInterface;

class CommandQueryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CommandBusInterface::class, CommandBus::class);
        $this->app->singleton(QueryBusInterface::class, QueryBus::class);

        $this->app->singleton(CommandBus::class, function ($app) {
            $handlerLocator = new CommandHandlerLocator();
            $handlerInflector = new HandlerInflector();

            $commandBus = new CommandBus($handlerLocator, $handlerInflector);

            $transactionMiddleware = new TransactionMiddleware(
                $app->make(TransactionManagerInterface::class)
            );

            $commandBus->addMiddleware($transactionMiddleware);

            $this->registerCommands($commandBus);

            return $commandBus;
        });

        $this->app->singleton(QueryBus::class, function ($app) {
            $handlerLocator = new QueryHandlerLocator();
            $handlerInflector = new HandlerInflector();

            $queryBus = new QueryBus($handlerLocator, $handlerInflector);

            $this->registerQueries($queryBus);

            return $queryBus;
        });
    }

    private function registerCommands(CommandBus $commandBus): void
    {
        $commandBus->register(UpdateUserPassword::class, UpdateUserPasswordHandler::class);
    }

    private function registerQueries(QueryBus $queryBus): void {}

    public function boot(): void {}
}
