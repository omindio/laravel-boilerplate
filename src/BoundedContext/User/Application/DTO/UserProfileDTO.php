<?php

namespace App\Application\User\DTO;

class UserProfileDTO
{
    protected $name;
    protected $surname;

    public function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
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
