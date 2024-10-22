<?php

namespace App\BoundedContext\Authentication\Domain\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;

interface AuthenticationCommandRepositoryInterface
{
    public function createPasswordResetToken(User $user): PasswordResetToken;
}
