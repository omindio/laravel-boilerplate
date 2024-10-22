<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\Exception\SamePasswordException;

class UpdatePassword
{
    private string $currentPassword;
    private Password $newPassword;

    public function __construct(string $currentPassword, string $newPassword)
    {
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
