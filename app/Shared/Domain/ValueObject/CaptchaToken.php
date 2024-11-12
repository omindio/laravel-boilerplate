<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\EmptyCaptchaTokenException;

class CaptchaToken
{
    private string $token;

    public function __construct(string $token)
    {
        if (empty($token)) {
            throw new EmptyCaptchaTokenException();
        }

        $this->token = $token;
    }

    public function value(): string
    {
        return $this->token;
    }
}
