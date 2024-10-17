<?php

namespace App\BoundedContext\Authentication\Application\Command;

use App\BoundedContext\Authentication\Application\Command\LoginUserSession;
use App\BoundedContext\Authentication\Application\Response\UserAuthenticatedResponse;
use App\BoundedContext\Authentication\Application\Service\AuthenticationSessionService;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;

class LoginUserSessionHandler
{
    private $authenticationService;

    public function __construct(AuthenticationSessionService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function handle(LoginUserSession $command): UserAuthenticatedResponse
    {
        $email = new Email($command->getEmail());
        $password = new Password($command->getPassword());

        $user = $this->authenticationService->login(
            $email,
            $password
        );

        return new UserAuthenticatedResponse($user->getEmail()->value(), $user->getRoles()->toArray(), $user->getPermissions()->toArray());
    }
}
