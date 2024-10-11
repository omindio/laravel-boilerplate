<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Infrastructure\Bus\Exception\HandlerNotFoundException;

class QueryHandlerLocator
{
    private array $handlers = [];

    public function register(string $queryClass, $handler): void
    {
        $this->handlers[$queryClass] = $handler;
    }

    public function getHandler($query)
    {
        $queryClass = get_class($query);

        if (!isset($this->handlers[$queryClass])) {
            throw new HandlerNotFoundException("Handler not found for query: " . get_class($query));
        }

        return $this->handlers[$queryClass];
    }
}
