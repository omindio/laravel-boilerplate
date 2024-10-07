<?php

namespace App\Domain\User\Domain\Entities;

use App\Domain\User\Domain\Abstracts\BaseUser;
use App\Domain\User\Domain\ValueObjects\PasswordValueObject;

class UserEntity extends BaseUser
{
    private PasswordValueObject $password;

    public function __construct(int $id, string $name, string $email, PasswordValueObject $password, string $createdAt, array $roles, array $permissions)
    {
        parent::__construct($id, $name, $email, $createdAt, $roles, $permissions);
        $this->password = $password;
    }

    public function updateProfile(array $data)
    {
        $this->update($data);
    }

    public function setPassword(PasswordValueObject $newHashedPassword)
    {
        $this->password = $newHashedPassword;
    }

    public function getPassword(): string
    {
        return $this->password->getPassword();
    }

    public function update(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
