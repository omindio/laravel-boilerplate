<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Infrastructure\Bus\CommandHandlerLocator;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Infrastructure\Bus\HandlerInflector;
use App\Shared\Application\Contract\BusMiddlewareInterface;

class CommandBus implements CommandBusInterface
{
    private CommandHandlerLocator $locator;
    private HandlerInflector $inflector;
    private array $middlewares = [];

    public function __construct(CommandHandlerLocator $locator, HandlerInflector $inflector)
    {
        $this->locator = $locator;
        $this->inflector = $inflector;
    }

    public function addMiddleware(BusMiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function dispatch($command)
    {
        $handler = $this->locator->getHandler($command);
        $method = $this->inflector->inflect($command);

        $executionChain = array_reduce(
            array_reverse($this->middlewares),
            fn($next, $middleware) => fn($cmd) => $middleware->handle($cmd, $next),
            fn($cmd) => $handler->$method($cmd)
        );

        return $executionChain($command);
    }

    public function register(string $commandClass, string $handlerClass)
    {
        $this->locator->register($commandClass, $handlerClass);
    }
}
