<?php

namespace App\BoundedContext\Authentication\Application\Query;

use App\BoundedContext\Authentication\Application\Query\GetUserAuthenticated;
use App\BoundedContext\Authentication\Application\Response\UserAuthenticatedResponse;
use App\BoundedContext\Authentication\Application\Service\AuthenticationService;
use App\Shared\Domain\ValueObject\UserId;

class GetUserProfileHandler
{
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function handle(GetUserAuthenticated $query): UserAuthenticatedResponse
    {
        $userId = new UserId($query->getUserId());

        $user = $this->authenticationService->getUser(
            $userId
        );

        return new UserAuthenticatedResponse(
            $user->getEmail()->value(),
            $user->getRoles(),
            $user->getPermissions()
        );
    }
}
