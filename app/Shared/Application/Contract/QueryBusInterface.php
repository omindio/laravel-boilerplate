<?php

namespace App\Shared\Application\Contract;

interface QueryBusInterface
{
    public function ask($query);
    public function register(string $queryClass, string $handlerClass);
}
