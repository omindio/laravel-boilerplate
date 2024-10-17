<?php

namespace App\Shared\Infrastructure\Bus;

class HandlerInflector
{
    public function inflect($command)
    {
        return 'handle';
    }
}
