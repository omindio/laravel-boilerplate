<?php

namespace App\BoundedContext\Authentication\Application\Command;

use App\BoundedContext\Authentication\Application\Service\PasswordResetService;
use App\BoundedContext\Authentication\Application\Command\RequestPasswordReset;
use App\Shared\Domain\ValueObject\CaptchaToken;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Ip;

class RequestPasswordResetHandler
{
    private PasswordResetService $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function handle(RequestPasswordReset $command)
    {
        $email = new Email($command->getEmail());
        $captchaToken = new CaptchaToken($command->getCaptchaToken());
        $ip = new Ip($command->getIp());

        $this->passwordResetService->requestPasswordReset($email, $captchaToken, $ip);
    }
}
