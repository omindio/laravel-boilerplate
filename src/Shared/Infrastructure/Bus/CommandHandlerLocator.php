<?php

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Infrastructure\Bus\Exception\HandlerNotFoundException;

class CommandHandlerLocator
{
    private array $handlers = [];

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

        return $this->handlers[$commandClass];
    }
}
