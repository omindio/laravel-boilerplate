<?php

namespace App\Shared\Application\Bus;

use App\Shared\Application\Bus\QueryHandlerLocator;
use App\Shared\Application\Bus\HandlerInflector;
use App\Shared\Application\Contract\QueryBusInterface;
use App\Shared\Application\Contract\BusMiddlewareInterface;

class QueryBus implements QueryBusInterface
{
    private QueryHandlerLocator $handlerLocator;
    private HandlerInflector $handlerInflector;
    private array $middlewares = [];

    public function __construct(QueryHandlerLocator $handlerLocator, HandlerInflector $handlerInflector)
    {
        $this->handlerLocator = $handlerLocator;
        $this->handlerInflector = $handlerInflector;
    }

    public function addMiddleware(BusMiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function execute($query)
    {
        $handler = $this->handlerLocator->getHandler($query);
        $method = $this->handlerInflector->inflect($query);

        $executionChain = array_reduce(
            array_reverse($this->middlewares),
            fn($next, $middleware) => fn($qry) => $middleware->handle($qry, $next),
            fn($qry) => $handler->$method($qry)
        );

        return $executionChain($query);
    }

    public function register(string $queryClass, string $handlerClass)
    {
        $this->handlerLocator->register($queryClass, $handlerClass);
    }
}
