<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\BoundedContext\User\Domain\Exception\EmptySurnameException;

class Surname
{
    private string $surname;

    public function __construct(string $surname)
    {
        if (empty($surname)) {
            throw new EmptySurnameException();
        }

        $this->surname = $surname;
    }

    public function value(): string
    {
        return $this->surname;
    }
}
