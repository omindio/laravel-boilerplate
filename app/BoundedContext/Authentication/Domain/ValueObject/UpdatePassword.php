<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\Exception\SamePasswordException;

class UpdatePassword
{
    private Password $newPassword;
    private Password $confirmPassword;

    public function __construct(string $newPassword, string $confirmPassword)
    {
        if ($confirmPassword != $newPassword) {
            throw new SamePasswordException('Las contraseñas no coinciden.');
        }
        $this->confirmPassword = new Password($confirmPassword);
        $this->newPassword = new Password($newPassword);
    }

    public function getNewPassword(): Password
    {
        return $this->newPassword;
    }

    public function getConfirmPassword(): Password
    {
        return $this->confirmPassword;
    }
}
