<?php

namespace App\BoundedContext\User\Application\DTOs;

class UserDTO
{
    private int $id;
    private string $name;
    private string $surname;
    private string $email;
    private string $createdAt;
    private array $roles;
    private array $permissions;

    public function __construct(int $id, string $name, string $surname, string $email, string $createdAt, array $roles, array $permissions)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }
}
