<?php

namespace App\Shared\Application\Contract;

interface CommandBusInterface
{
    public function dispatch($command);
    public function register(string $commandClass, string $handlerClass);
}
