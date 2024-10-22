<?php

namespace App\BoundedContext\User\Application\Service;

use App\Shared\Domain\Contract\PasswordServiceInterface;
use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\Shared\Domain\ValueObject\UpdatePassword;
use App\Shared\Domain\ValueObject\UserId;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\Exception\UserNotFoundException;
use App\Shared\Domain\Exception\IncorrectPasswordException;

class UserPasswordService
{
    private $passwordService;
    private $userQueryRepository;
    private $userCommandRepository;

    public function __construct(PasswordServiceInterface $passwordService, UserQueryRepositoryInterface $userQueryRepository, UserCommandRepositoryInterface $userCommandRepository)
    {
        $this->passwordService = $passwordService;
        $this->userQueryRepository = $userQueryRepository;
        $this->userCommandRepository = $userCommandRepository;
    }

    public function update(UserId $userId, UpdatePassword $passwordValueObject): void
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!$this->passwordService->verify($passwordValueObject->getCurrentPassword(), $user->getPassword()->value())) {
            throw new IncorrectPasswordException();
        }

        $hashedPasswordValueObject = $this->passwordService->hash($passwordValueObject->getNewPassword()->value());

        $user->setPassword(new Password($hashedPasswordValueObject));

        $this->userCommandRepository->updatePassword($user);
    }
}
