<?php

namespace App\Domain\User\Domain\Mappers;

use App\Shared\Domain\Mappers\MapperInterface;
use App\Domain\User\Domain\Entities\UserEntity;
use App\Domain\User\Domain\ValueObjects\PasswordValueObject;

class UserMapper implements MapperInterface
{
    public static function fromArrayToEntity(array $data): UserEntity
    {
        return new UserEntity(
            $data['id'],
            $data['name'],
            $data['email'],
            isset($data['password']) ? new PasswordValueObject($data['password'], true) : null,
            $data['created_at'],
            $data['roles'],
            $data['permissions'],
        );
    }
}
