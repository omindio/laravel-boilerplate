<?php

namespace App\Domain\User\Domain\Services;

use App\Domain\User\Domain\Entities\UserEntity;
use App\Domain\User\Domain\Exceptions\IncorrectPasswordException;
use App\Domain\User\Domain\Exceptions\InvalidPasswordException;
use App\Domain\User\Domain\Interfaces\PasswordServiceInterface;
use App\Domain\User\Domain\Repositories\UserRepositoryInterface;
use App\Domain\User\Domain\ValueObjects\UpdatePasswordValueObject;

class UserPasswordDomainService
{
    private $userRepository;
    private $passwordService;

    public function __construct(UserRepositoryInterface $userRepository, PasswordServiceInterface $passwordService)
    {
        $this->userRepository = $userRepository;
        $this->passwordService = $passwordService;
    }

    public function update(UserEntity $user, UpdatePasswordValueObject $passwordValueObject)
    {
        if (!$this->passwordService->verify($passwordValueObject->getCurrentPassword(), $user->getPassword())) {
            throw new IncorrectPasswordException();
        }

        $hashedPasswordValueObject = $this->passwordService->hash($passwordValueObject->getNewPassword()->getPassword());

        $user->setPassword($hashedPasswordValueObject);
        $this->userRepository->updatePassword($user);
    }
}
