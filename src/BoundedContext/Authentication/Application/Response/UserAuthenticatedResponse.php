<?php

namespace App\BoundedContext\Authentication\Application\Response;

class UserAuthenticatedResponse
{
    protected $email;
    protected $roles;
    protected $permissions;

    public function __construct(string $email, array $roles, array $permissions)
    {
        $this->email = $email;
        $this->roles = $roles;
        $this->permissions = $permissions;
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
            'email' => $this->email,
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ];
    }
}
