<?php

namespace App\BoundedContext\Authentication\Domain\Entity;

use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;

class User
{
    private UserId $id;
    private Email $email;
    private Password $password;
    private array $roles;
    private array $permissions;

    public function __construct(UserId $id, Email $email, Password $password, array $roles, array $permissions)
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

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function setEmail(Email $newEmail)
    {
        $this->email = $newEmail;
    }

    public function setPassword(Password $newHashedPassword)
    {
        $this->password = $newHashedPassword;
    }

    public function setRoles(array $newRoles)
    {
        $this->roles = $newRoles;
    }

    public function setPermissions(array $newPermissions)
    {
        $this->permissions = $newPermissions;
    }
}
