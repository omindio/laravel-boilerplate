<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Password;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createPasswordResetToken(User $user): string
    {
        return Password::createToken($user);
    }

    public function updatePassword(User $user, string $hashedPassword): bool
    {
        $user->forceFill([
            'password' => $hashedPassword
        ]);
        return $user->save();
    }
}
