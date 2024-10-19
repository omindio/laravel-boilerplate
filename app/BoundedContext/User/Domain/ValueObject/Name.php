<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\BoundedContext\User\Domain\Exception\EmptyNameException;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new EmptyNameException();
        }

        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}
