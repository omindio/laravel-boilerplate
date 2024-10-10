<?php

namespace App\BoundedContext\User\Application\Command;

class UpdateUserPassword
{
    private int $userId;
    private string $currentPassword;
    private string $newPassword;

    public function __construct(int $userId, string $currentPassword, string $newPassword)
    {
        $this->userId = $userId;
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}
