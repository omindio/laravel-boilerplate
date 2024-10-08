<?php

namespace App\Domain\User\Domain\ValueObjects;

use App\Domain\User\Domain\Exceptions\EmptyPasswordException;
use App\Domain\User\Domain\Exceptions\InvalidPasswordException;

class PasswordValueObject
{
    private string $password;

    public function __construct(string $password, bool $isHashed = false)
    {
        if (empty($hashedPassword)) {
            throw new EmptyPasswordException('No puedes introducir una contraseña vacía.');
        }

        if (!$isHashed) {
            $this->validate($password);
        }

        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    private function validate(string $plainPassword): bool
    {
        if (strlen($plainPassword) < 8) {
            throw new InvalidPasswordException();
        }

        //TODO: Mas validaciones como mayúsculas, minúsculas, números, caracteres especiales, etc.

        return true;
    }
}
