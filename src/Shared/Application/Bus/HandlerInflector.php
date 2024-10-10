<?php

namespace App\Shared\Application\Bus;

class HandlerInflector
{
    public function inflect($command)
    {
        return 'handle';
    }
}
