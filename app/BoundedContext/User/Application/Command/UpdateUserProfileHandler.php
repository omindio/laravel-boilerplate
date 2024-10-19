<?php

namespace App\BoundedContext\User\Application\Command;

use App\BoundedContext\User\Application\Command\UpdateUserProfile;
use App\BoundedContext\User\Application\Response\UserProfileResponse;
use App\BoundedContext\User\Application\Service\UserProfileService;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\BoundedContext\User\Domain\ValueObject\Name;
use App\BoundedContext\User\Domain\ValueObject\Surname;
use App\Shared\Domain\ValueObject\UserId;

class UpdateUserProfileHandler
{
    private $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    public function handle(UpdateUserProfile $command): UserProfileResponse
    {
        $profileValueObject = new Profile(
            new Name($command->getName()),
            new Surname($command->getSurname()),
        );

        $userId = new UserId($command->getUserId());

        $profile = $this->userProfileService->update(
            $userId,
            $profileValueObject
        );

        return new UserProfileResponse(
            $profile->getName()->value(),
            $profile->getSurname()->value()
        );
    }
}
