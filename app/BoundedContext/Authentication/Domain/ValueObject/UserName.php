<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

class UserName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}
