<?php

namespace App\Domain\User\Domain\Entities;

use App\Domain\User\Domain\ValueObjects\EmailValueObject;
use App\Domain\User\Domain\ValueObjects\PasswordValueObject;
use App\Domain\User\Domain\ValueObjects\ProfileValueObject;

class UserEntity
{
    private int $id;
    private ProfileValueObject $profile;
    private EmailValueObject $email;
    private ?PasswordValueObject $password;
    private string $createdAt;
    private array $roles;
    private array $permissions;

    public function __construct(int $id, ProfileValueObject $profile, EmailValueObject $email, ?PasswordValueObject $password, string $createdAt, array $roles, array $permissions)
    {
        $this->id = $id;
        $this->profile = $profile;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProfileName(): string
    {
        return $this->profile->getName();
    }

    public function getProfileSurname(): string
    {
        return $this->profile->getSurname();
    }

    public function getEmailAddress(): string
    {
        return $this->email->getEmail();
    }

    public function getPasswordValue(): string
    {
        return $this->password ? $this->password->getPassword() : '';
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

    public function setProfile(ProfileValueObject $newProfile)
    {
        $this->profile = $newProfile;
    }

    public function setEmail(EmailValueObject $newEmail)
    {
        $this->email = $newEmail;
    }

    public function setPassword(PasswordValueObject $newHashedPassword)
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
