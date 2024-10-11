<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Infrastructure\Bus\CommandHandlerLocator;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Infrastructure\Bus\HandlerInflector;
use App\Shared\Application\Contract\BusMiddlewareInterface;

class CommandBus implements CommandBusInterface
{
    private CommandHandlerLocator $handlerLocator;
    private HandlerInflector $handlerInflector;
    private array $middlewares = [];

    public function __construct(CommandHandlerLocator $handlerLocator, HandlerInflector $handlerInflector)
    {
        $this->handlerLocator = $handlerLocator;
        $this->handlerInflector = $handlerInflector;
    }

    public function addMiddleware(BusMiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function execute($command)
    {
        $handler = $this->handlerLocator->getHandler($command);
        $method = $this->handlerInflector->inflect($command);

        $executionChain = array_reduce(
            array_reverse($this->middlewares),
            fn($next, $middleware) => fn($cmd) => $middleware->handle($cmd, $next),
            fn($cmd) => $handler->$method($cmd)
        );

        return $executionChain($command);
    }

    public function register(string $commandClass, string $handlerClass)
    {
        $this->handlerLocator->register($commandClass, $handlerClass);
    }
}
