<?php

namespace App\Shared\Application\Contract;

interface QueryBusInterface
{
    public function execute($query);
    public function register(string $queryClass, string $handlerClass);
}
