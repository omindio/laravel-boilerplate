<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\EmptyPasswordException;
use App\Shared\Domain\Exception\InvalidPasswordException;

class Password
{
    private string $password;

    public function __construct(string $password, bool $isHashed = false)
    {
        if (empty($password)) {
            throw new EmptyPasswordException('No puedes introducir una contraseña vacía.');
        }

        if (!$isHashed) {
            $this->validate($password);
        }

        $this->password = $password;
    }

    public function value(): string
    {
        return $this->password;
    }

    private function validate(string $password): bool
    {
        if (strlen($password) < 8) {
            throw new InvalidPasswordException();
        }

        //TODO: Mas validaciones como mayúsculas, minúsculas, números, caracteres especiales, etc.

        return true;
    }
}
