<?php

namespace App\BoundedContext\User\Domain\Entity;

use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\User\Domain\ValueObject\Profile;

class User
{
    private UserId $id;
    private Profile $profile;
    private Email $email;
    private Password $password;
    private string $createdAt;
    private array $roles;
    private array $permissions;

    public function __construct(UserId $id, Profile $profile, Email $email, Password $password, string $createdAt, array $roles, array $permissions)
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

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
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

    public function setRoles(array $newRoles)
    {
        $this->roles = $newRoles;
    }

    public function setPermissions(array $newPermissions)
    {
        $this->permissions = $newPermissions;
    }
}
