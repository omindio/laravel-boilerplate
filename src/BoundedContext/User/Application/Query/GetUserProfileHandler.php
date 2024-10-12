<?php

namespace App\BoundedContext\User\Application\Query;

use App\BoundedContext\User\Application\Query\GetUserProfile;
use App\BoundedContext\User\Application\Response\UserProfileResponse;
use App\BoundedContext\User\Application\Service\UserProfileService;
use App\Shared\Domain\ValueObject\UserId;

class GetUserProfileHandler
{
    private $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    public function handle(GetUserProfile $query): UserProfileResponse
    {
        $userId = new UserId($query->getUserId());

        $profile = $this->userProfileService->getProfile(
            $userId
        );

        return new UserProfileResponse(
            $profile->getName()->value(),
            $profile->getSurname()->value()
        );
    }
}
