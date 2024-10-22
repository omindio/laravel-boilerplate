<?php

namespace App\BoundedContext\User\Domain\Entity;

use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\BoundedContext\User\Domain\ValueObject\RoleCollection;
use App\BoundedContext\User\Domain\ValueObject\PermissionCollection;
use App\BoundedContext\User\Domain\Entity\Role;

class User
{
    private UserId $id;
    private Profile $profile;
    private Email $email;
    private Password $password;
    private RoleCollection $roles;
    private PermissionCollection $permissions;
    private string $createdAt;

    public function __construct(UserId $id, Profile $profile, Email $email, Password $password, RoleCollection $roles, PermissionCollection $permissions, string $createdAt)
    {
        $this->id = $id;
        $this->profile = $profile;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): ?Password
    {
        return $this->password;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getRoles(): RoleCollection
    {
        return $this->roles;
    }

    public function getPermissions(): PermissionCollection
    {
        return $this->permissions;
    }

    public function setProfile(Profile $newProfile)
    {
        $this->profile = $newProfile;
    }

    public function setEmail(Email $newEmail)
    {
        $this->email = $newEmail;
    }

    public function setPassword(Password $newHashedPassword)
    {
        $this->password = $newHashedPassword;
    }

    public function setCreatedAt(string $newCreatedAt)
    {
        $this->createdAt = $newCreatedAt;
    }

    public function setRoles(RoleCollection $newRoles)
    {
        $this->roles = $newRoles;
    }

    public function setPermissions(PermissionCollection $newPermissions)
    {
        $this->permissions = $newPermissions;
    }

    public function addRole(Role $role)
    {
        $this->roles->add($role);
    }

    public function hasRole(Role $role): bool
    {
        return $this->roles->has($role);
    }
}
