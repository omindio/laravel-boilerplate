<?php

namespace App\BoundedContext\Authentication\Infrastructure\Service;

use App\BoundedContext\Authentication\Application\Contract\AuthenticationPasswordTokenValidationServiceInterface;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class LaravelAuthenticationPasswordTokenValidationService implements AuthenticationPasswordTokenValidationServiceInterface
{
    public function isValidToken(PasswordResetToken $token, PasswordResetToken $hashedToken): bool
    {
        return Hash::check($token->getToken(), $hashedToken->getToken());
    }

    public function isTokenExpired(PasswordResetToken $token): bool
    {
        return Carbon::parse($token->getCreatedAt())->addMinutes(config('auth.passwords.users.expire'))->isPast();
    }
}
