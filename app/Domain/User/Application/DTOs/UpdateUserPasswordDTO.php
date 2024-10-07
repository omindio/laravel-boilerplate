<?php

namespace App\Domain\User\Application\DTOs;

class UpdateUserPasswordDTO
{
    private string $currentPassword;
    private string $newPassword;
    private string $confirmPassword;

    public function __construct(string $currentPassword, string $newPassword, string $confirmPassword)
    {
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
        $this->confirmPassword = $confirmPassword;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
}
