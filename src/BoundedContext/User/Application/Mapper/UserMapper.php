<?php

namespace App\Application\User\Mappers;

use App\Domain\User\Application\DTOs\UserDTO;
use App\Shared\Application\Mappers\MapperInterface;
use App\Domain\User\Domain\Entities\UserEntity;
use App\Domain\User\Domain\ValueObjects\ProfileValueObject;
use App\Domain\User\Domain\ValueObjects\EmailValueObject;

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

    public static function fromDTOToEntity(UserDTO $userDTO): UserEntity
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
