<?php

namespace App\Shared\Application\Contract;

interface QueryBusInterface
{
    public function dispatch($query);
    public function register(string $queryClass, string $handlerClass);
}
