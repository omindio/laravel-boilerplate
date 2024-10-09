<?php

namespace App\Application\User\Mappers;

use App\BoundedContext\User\Application\DTOs\UserDTO;
use App\Shared\Application\Mapper\MapperInterface;
use App\BoundedContext\User\Domain\Entity\UserEntity;
use App\BoundedContext\User\Domain\ValueObject\ProfileValueObject;
use App\BoundedContext\User\Domain\ValueObject\EmailValueObject;

class UserMapper implements MapperInterface
{
    protected $tokenService;

    public static function fromEntityToDTO($userEntity): UserDTO
    {
        return new UserDTO(
            $userEntity->getId(),
            $userEntity->getProfileName(),
            $userEntity->getProfileSurname(),
            $userEntity->getEmail(),
            $userEntity->getCreatedAt(),
            $userEntity->getRoles(),
            $userEntity->getPermissions()
        );
    }

    public static function fromArrayToDTO(array $data): UserDTO
    {
        return new UserDTO(
            $data['id'],
            $data['name'],
            $data['surname'],
            $data['email'],
            $data['created_at'],
            $data['roles'],
            $data['permissions']
        );
    }

    public static function fromCommandToEntity($userDTO): UserDTO
    {
        return new UserEntity(
            $userDTO->getId(),
            new ProfileValueObject($userDTO->getName(), $userDTO->getSurname()),
            new EmailValueObject($userDTO->getEmail()),
            null,
            $userDTO->getCreatedAt(),
            $userDTO->getRoles(),
            $userDTO->getPermissions(),
        );
    }
}
