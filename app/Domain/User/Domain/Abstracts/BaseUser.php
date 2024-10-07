<?php

namespace App\Domain\User\Domain\Abstracts;

abstract class BaseUser
{
    protected int $id;
    protected string $name;
    protected string $email;
    protected string $createdAt;
    protected array $roles;
    protected array $permissions;

    public function __construct(int $id, string $name, string $email, string $createdAt, array $roles, array $permissions)
    {
        $this->id = $id;
        $this->name = $name;
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
