<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\EmptyCaptchaTokenException;

class CaptchaToken
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new EmptyCaptchaTokenException();
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
