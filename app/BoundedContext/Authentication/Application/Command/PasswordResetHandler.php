<?php

namespace App\BoundedContext\Authentication\Application\Command;

use App\BoundedContext\Authentication\Application\Service\PasswordResetService;
use App\BoundedContext\Authentication\Application\Command\PasswordReset;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;
use App\BoundedContext\Authentication\Domain\ValueObject\UpdatePassword;
use App\Shared\Domain\ValueObject\Email;

class PasswordResetHandler
{
    private PasswordResetService $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function handle(PasswordReset $command)
    {
        $email = new Email($command->getEmail());
        $updatePassword = new UpdatePassword($command->getNewPassword(), $command->getConfirmPassword());
        $token = new PasswordResetToken($command->getToken());

        $this->passwordResetService->passwordReset($email, $updatePassword, $token);
    }
}
