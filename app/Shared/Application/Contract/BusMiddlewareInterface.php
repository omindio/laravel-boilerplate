<?php

namespace App\Shared\Application\Contract;

interface BusMiddlewareInterface
{
    public function handle($command, callable $next);
}
