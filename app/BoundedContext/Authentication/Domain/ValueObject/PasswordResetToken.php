<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\BoundedContext\Authentication\Domain\Exception\EmptyPasswordResetTokenException;

class PasswordResetToken
{
    private string $token;
    private ?string $createdAt;

    public function __construct(string $token, ?string $createdAt = null)
    {
        if (empty($token)) {
            throw new EmptyPasswordResetTokenException();
        }

        $this->token = $token;
        $this->createdAt = $createdAt;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
}
