<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\BoundedContext\Authentication\Domain\Exception\EmptyPasswordResetTokenException;

class PasswordResetToken
{
    private string $token;

    public function __construct(string $token)
    {
        if (empty($token)) {
            throw new EmptyPasswordResetTokenException();
        }

        $this->token = $token;
    }

    public function value(): string
    {
        return $this->token;
    }
}
