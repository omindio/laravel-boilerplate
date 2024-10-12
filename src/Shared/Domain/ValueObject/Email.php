<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidEmailException;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}
