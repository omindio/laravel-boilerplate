<?php

namespace App\BoundedContext\User\Application\Command;

class UpdateUserProfile
{
    private int $userId;
    private string $name;
    private string $surname;

    public function __construct(int $userId, string $name, string $surname)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }
}
