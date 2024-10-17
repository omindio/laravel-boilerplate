<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Infrastructure\Bus\Exception\HandlerNotFoundException;
use Illuminate\Contracts\Container\Container;

class CommandHandlerLocator
{
    private array $handlers = [];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register(string $commandClass, $handler): void
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function getHandler($command)
    {
        $commandClass = get_class($command);

        if (!isset($this->handlers[$commandClass])) {
            throw new HandlerNotFoundException("Handler not found for command: " . get_class($command));
        }

        return $this->container->make($this->handlers[$commandClass]);
    }
}
