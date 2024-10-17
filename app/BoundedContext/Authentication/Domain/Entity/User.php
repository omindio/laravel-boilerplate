<?php

namespace App\BoundedContext\Authentication\Domain\Entity;

use App\BoundedContext\Authentication\Domain\ValueObject\RoleCollection;
use App\BoundedContext\Authentication\Domain\ValueObject\PermissionCollection;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;

class User
{
    private UserId $id;
    private Email $email;
    private Password $password;
    private RoleCollection $roles;
    private PermissionCollection $permissions;

    public function __construct(UserId $id, Email $email, Password $password, RoleCollection $roles, PermissionCollection $permissions)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): ?Password
    {
        return $this->password;
    }

    public function getRoles(): RoleCollection
    {
        return $this->roles;
    }

    public function getPermissions(): PermissionCollection
    {
        return $this->permissions;
    }
}
