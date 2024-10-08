<?php

namespace App\Domain\User\Domain\ValueObjects;

use App\Domain\User\Domain\Exceptions\InvalidEmailException;

class EmailValueObject
{
    private $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
