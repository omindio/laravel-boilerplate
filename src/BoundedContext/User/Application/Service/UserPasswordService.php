<?php

namespace App\Domain\User\Application\Services;

use App\Domain\User\Domain\Services\UserPasswordService as DomainUserPasswordService;
use App\Domain\User\Domain\Repositories\UserRepositoryInterface;
use App\Domain\User\Application\DTOs\UpdatePasswordDTO;
use App\Domain\User\Domain\Exceptions\UserNotFoundException;
use App\Domain\User\Domain\ValueObjects\UpdatePasswordValueObject;

class UserPasswordService
{
    private $domainUserPasswordService;
    private $userRepository;

    public function __construct(DomainUserPasswordService $domainUserPasswordService, UserRepositoryInterface $userRepository)
    {
        $this->domainUserPasswordService = $domainUserPasswordService;
        $this->userRepository = $userRepository;
    }

    public function update(int $userId, UpdatePasswordDTO $updatePasswordDTO)
    {
        $userEntity = $this->userRepository->findById($userId);

        if (!$userEntity) {
            throw new UserNotFoundException();
        }

        $passwordValueObject = new UpdatePasswordValueObject($updatePasswordDTO->getCurrentPassword(), $updatePasswordDTO->getNewPassword());
        $this->domainUserPasswordService->update($userEntity, $passwordValueObject);
    }
}
