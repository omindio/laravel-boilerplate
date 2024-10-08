<?php

namespace App\Domain\User\Domain\ValueObjects;

use App\Domain\User\Domain\ValueObjects\PasswordValueObject;
use App\Domain\User\Domain\Exceptions\SamePasswordException;

class UpdatePasswordValueObject
{
    private string $currentPassword;
    private PasswordValueObject $newPassword;

    public function __construct(string $currentPassword, string $newPassword)
    {
        //TODO: Comprobar que las contrasñeas no son iguales
        if ($currentPassword === $newPassword) {
            throw new SamePasswordException();
        }
        $this->currentPassword = $currentPassword;
        $this->newPassword = new PasswordValueObject($newPassword);
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getNewPassword(): PasswordValueObject
    {
        return $this->newPassword;
    }
}
