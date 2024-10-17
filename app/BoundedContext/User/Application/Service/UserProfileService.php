<?php

namespace App\BoundedContext\User\Application\Service;

use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\Shared\Domain\Exception\UserNotFoundException;

class UserProfileService
{
    private $userQueryRepository;
    private $userCommandRepository;

    public function __construct(UserQueryRepositoryInterface $userQueryRepository, UserCommandRepositoryInterface $userCommandRepository)
    {
        $this->userQueryRepository = $userQueryRepository;
        $this->userCommandRepository = $userCommandRepository;
    }

    public function update(UserId $userId, Profile $profileValueObject): Profile
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->setProfile($profileValueObject);

        $this->userCommandRepository->updateProfile($user);

        return $user->getProfile();
    }

    public function getProfile(UserId $userId): Profile
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user->getProfile();
    }
}
