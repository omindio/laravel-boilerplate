<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Infrastructure\Bus\QueryHandlerLocator;
use App\Shared\Infrastructure\Bus\HandlerInflector;
use App\Shared\Application\Contract\QueryBusInterface;
use App\Shared\Application\Contract\BusMiddlewareInterface;

class QueryBus implements QueryBusInterface
{
    private QueryHandlerLocator $locator;
    private HandlerInflector $inflector;
    private array $middlewares = [];

    public function __construct(QueryHandlerLocator $locator, HandlerInflector $inflector)
    {
        $this->locator = $locator;
        $this->inflector = $inflector;
    }

    public function addMiddleware(BusMiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function ask($query)
    {
        $handler = $this->locator->getHandler($query);
        $method = $this->inflector->inflect($query);

        $executionChain = array_reduce(
            array_reverse($this->middlewares),
            fn($next, $middleware) => fn($qry) => $middleware->handle($qry, $next),
            fn($qry) => $handler->$method($qry)
        );

        return $executionChain($query);
    }

    public function register(string $queryClass, string $handlerClass)
    {
        $this->locator->register($queryClass, $handlerClass);
    }
}
