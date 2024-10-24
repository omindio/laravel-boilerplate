<?php

namespace App\BoundedContext\Authentication\Domain\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;

interface AuthenticationCommandRepositoryInterface
{
    public function createPasswordToken(User $user): PasswordResetToken;
    public function deletePasswordToken(Email $email, PasswordResetToken $token): void;
}
