<?php

namespace App\Application\User\Mappers;

use App\Domain\User\Application\DTOs\UserDTO;
use App\Domain\User\Domain\Entities\UserEntity;
use App\Shared\Mappers\MapperInterface;

class UserMapper implements MapperInterface
{
    protected $hashingService;
    protected $tokenService;

    public static function fromModelToEntity($model): UserEntity
    {
        return new UserEntity(
            $model->id,
            $model->name,
            $model->email,
            $model->password,
            $model->created_at,
            $model->roles,
            $model->permissions,
        );
    }

    public static function fromDTOToEntity($userDTO): UserEntity
    {
        return new UserEntity(
            $userDTO->getId(),
            $userDTO->getName(),
            $userDTO->getEmail(),
            '',
            $userDTO->getCreatedAt(),
            $userDTO->getRoles(),
            $userDTO->getPermissions(),
        );
    }

    public static function fromEntityToDTO($userEntity): UserDTO
    {
        return new UserDTO(
            $userEntity->getId(),
            $userEntity->getName(),
            $userEntity->getEmail(),
            $userEntity->getCreatedAt(),
            $userEntity->getRoles(),
            $userEntity->getPermissions()
        );
    }
}
