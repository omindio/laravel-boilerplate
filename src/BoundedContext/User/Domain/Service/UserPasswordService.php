<?php

namespace App\BoundedContext\User\Domain\Service;

use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Domain\Entity\User;
use App\BoundedContext\User\Domain\Exception\IncorrectPasswordException;
use App\BoundedContext\User\Domain\Contract\UserPasswordServiceInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\User\Domain\ValueObject\UpdatePassword;
use App\BoundedContext\User\Domain\Exception\UserNotFoundException;
use App\BoundedContext\User\Domain\ValueObject\Id;

class UserPasswordService
{
    private $passwordService;
    private $userQueryRepository;
    private $userCommandRepository;

    public function __construct(UserPasswordServiceInterface $passwordService, UserQueryRepositoryInterface $userQueryRepository, UserCommandRepositoryInterface $userCommandRepository)
    {
        $this->passwordService = $passwordService;
        $this->userQueryRepository = $userQueryRepository;
        $this->userCommandRepository = $userCommandRepository;
        $this->passwordService = $passwordService;
    }

    public function update(Id $userId, UpdatePassword $passwordValueObject): void
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!$this->passwordService->verify($passwordValueObject->getCurrentPassword(), $user->getPassword()->value())) {
            throw new IncorrectPasswordException();
        }

        $hashedPasswordValueObject = $this->passwordService->hash($passwordValueObject->getNewPassword()->value());

        $user->setPassword($hashedPasswordValueObject);

        $this->userCommandRepository->updatePassword($user);
    }
}
