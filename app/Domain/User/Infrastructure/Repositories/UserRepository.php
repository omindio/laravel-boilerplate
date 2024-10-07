<?php

namespace App\Domain\User\Infrastructure\Repositories;

use App\Domain\User\Domain\Repositories\UserRepositoryInterface;
use App\Domain\User\Infrastructure\Models\UserModel;
use App\Domain\User\Domain\Entities\UserEntity;
use Illuminate\Support\Facades\Password;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?UserModel
    {
        return User::where('email', $email)->first();
    }

    public function createPasswordResetToken(User $user): string
    {
        return Password::createToken($user);
    }

    public function updatePassword(UserEntity $user): bool
    {
        return UserModel::where('id', $user->id)->update(['password' => $user->password]);
    }

    public function updateProfile(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
}
