<?php

namespace App\Shared\Application\Contract;

interface CommandBusInterface
{
    public function execute($command);
    public function register(string $commandClass, string $handlerClass);
}
