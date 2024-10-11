<?php

namespace App\BoundedContext\User\Domain\Service;

use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\User\Domain\ValueObject\Id;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\BoundedContext\User\Domain\Exception\UserNotFoundException;

class UserProfileService
{
    private $userQueryRepository;
    private $userCommandRepository;

    public function __construct(UserQueryRepositoryInterface $userQueryRepository, UserCommandRepositoryInterface $userCommandRepository)
    {
        $this->userQueryRepository = $userQueryRepository;
        $this->userCommandRepository = $userCommandRepository;
    }

    public function update(Id $userId, Profile $profileValueObject): Profile
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->setProfile($profileValueObject);

        $this->userCommandRepository->updateProfile($user);

        return $user->getProfile();
    }

    public function getProfile(Id $userId): Profile
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user->getProfile();
    }
}
