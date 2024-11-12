<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidIpException;

class Ip
{
    private string $ip;

    public function __construct(string $ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new InvalidIpException();
        }

        $this->ip = $ip;
    }

    public function value(): string
    {
        return $this->ip;
    }
}
