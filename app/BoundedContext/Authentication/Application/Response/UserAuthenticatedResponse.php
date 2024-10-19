<?php

namespace App\BoundedContext\Authentication\Application\Response;

class UserAuthenticatedResponse
{
    protected $name;
    protected $email;
    protected $roles;
    protected $permissions;

    public function __construct(string $name, string $email, array $roles, array $permissions)
    {
        $this->name = $name;
        $this->email = $email;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ];
    }
}
