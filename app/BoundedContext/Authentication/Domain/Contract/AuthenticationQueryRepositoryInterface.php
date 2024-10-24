<?php

namespace App\BoundedContext\Authentication\Domain\Contract;

use App\Shared\Domain\ValueObject\Email;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;

interface AuthenticationQueryRepositoryInterface
{
    public function findPasswordToken(Email $email): ?PasswordResetToken;
}
