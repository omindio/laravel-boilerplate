<?php

namespace App\BoundedContext\Authentication\Application\Service;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\Shared\Domain\Exception\UserNotFoundException;
use App\Shared\Domain\ValueObject\UserId;

class AuthenticationService
{

    private $userQueryRepository;

    public function __construct(UserQueryRepositoryInterface $userQueryRepository)
    {
        $this->userQueryRepository = $userQueryRepository;
    }

    public function getUser(UserId $userId): User
    {
        $user = $this->userQueryRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
