<?php

namespace App\Domain\User\Domain\ValueObjects;

use App\Domain\User\Domain\ValueObjects\PasswordValueObject;

class UpdatePasswordValueObject
{
    private string $currentPassword;
    private PasswordValueObject $newPassword;

    public function __construct(string $currentPassword, string $newPassword)
    {
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
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
