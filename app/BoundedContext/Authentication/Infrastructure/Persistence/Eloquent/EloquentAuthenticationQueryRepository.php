<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Domain\Contract\AuthenticationQueryRepositoryInterface;
use App\Shared\Domain\ValueObject\Email;
use Illuminate\Support\Facades\DB;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;

class EloquentAuthenticationQueryRepository implements AuthenticationQueryRepositoryInterface
{
    public function findPasswordToken(Email $email): ?PasswordResetToken
    {
        $tokenModel = DB::table(config('auth.passwords.users.table', 'password_reset_tokens'))
            ->where('email', $email->value())
            ->first();

        return $tokenModel ? new PasswordResetToken($tokenModel->token, $tokenModel->created_at) : null;
    }
}
