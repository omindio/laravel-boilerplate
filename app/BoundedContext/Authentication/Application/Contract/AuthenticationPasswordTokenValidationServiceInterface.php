<?php

namespace App\BoundedContext\Authentication\Application\Contract;

use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;

interface AuthenticationPasswordTokenValidationServiceInterface
{
    public function isValidToken(PasswordResetToken $token, PasswordResetToken $hashedToken): bool;
    public function isTokenExpired(PasswordResetToken $token): bool;
}
