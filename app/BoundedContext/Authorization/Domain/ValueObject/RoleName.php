<?php

namespace App\BoundedContext\Authorization\Domain\ValueObject;

use App\BoundedContext\Authorization\Domain\Exception\EmptyNameException;

class RoleName
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
