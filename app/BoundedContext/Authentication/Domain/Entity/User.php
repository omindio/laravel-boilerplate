<?php

namespace App\BoundedContext\Authentication\Domain\Entity;

use App\BoundedContext\Authentication\Domain\ValueObject\RoleCollection;
use App\BoundedContext\Authentication\Domain\ValueObject\PermissionCollection;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\Authentication\Domain\ValueObject\UserName;

class User
{
    private UserId $id;
    private UserName $name;
    private Email $email;
    private Password $password;
    private RoleCollection $roles;
    private PermissionCollection $permissions;

    public function __construct(UserId $id, UserName $name, Email $email, Password $password, RoleCollection $roles, PermissionCollection $permissions)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): UserName
    {
        return $this->name;
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
