<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidIpException;

class Ip
{
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_IP)) {
            throw new InvalidIpException();
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
