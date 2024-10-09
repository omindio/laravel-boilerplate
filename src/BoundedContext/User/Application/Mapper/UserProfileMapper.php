<?php

namespace App\Application\User\Mappers;

use App\Shared\Application\Mappers\MapperInterface;
use App\Application\User\DTOs\ProfileDTO;
use App\Application\User\DTOs\UpdateProfileDTO;

class ProfileMapper implements MapperInterface
{
    protected $tokenService;

    public static function fromEntityToDTO($userEntity): ProfileDTO
    {
        return new ProfileDTO(
            $userEntity->getProfileName(),
            $userEntity->getProfileSurname()
        );
    }

    public static function fromArrayToDTO(array $data): UpdateProfileDTO
    {
        return new UpdateProfileDTO(
            $data['name'],
            $data['surname'],
        );
    }
}
