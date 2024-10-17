<?php

namespace App\BoundedContext\Authentication\Application\Command;

use App\BoundedContext\Authentication\Application\Service\AuthenticationSessionService;

class LogoutUserSessionHandler
{
    private $authenticationService;

    public function __construct(AuthenticationSessionService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function handle(): void
    {
        $this->authenticationService->logout();
    }
}
