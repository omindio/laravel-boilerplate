<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Password;
use App\BoundedContext\User\Domain\Exception\SamePasswordException;

class UpdatePassword
{
    private string $currentPassword;
    private Password $newPassword;

    public function __construct(string $currentPassword, string $newPassword)
    {
        //TODO: Comprobar que las contrasñeas no son iguales
        if ($currentPassword === $newPassword) {
            throw new SamePasswordException();
        }
        $this->currentPassword = $currentPassword;
        $this->newPassword = new Password($newPassword);
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getNewPassword(): Password
    {
        return $this->newPassword;
    }
}
