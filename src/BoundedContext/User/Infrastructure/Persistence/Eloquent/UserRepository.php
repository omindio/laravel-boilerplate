<?php

namespace App\Domain\User\Infrastructure\Repositories;

use App\Domain\User\Domain\Repositories\UserRepositoryInterface;
use App\Domain\User\Infrastructure\Models\UserModel;
use App\Domain\User\Domain\Entities\UserEntity;
use App\Domain\User\Domain\Mappers\UserMapper;
// use Illuminate\Support\Facades\Password;

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?UserEntity
    {
        $userModel = UserModel::find($id);
        return $userModel ? UserMapper::fromArrayToEntity($userModel->toArray()) : null;
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $userModel = UserModel::where('email', $email)->first();
        return $userModel ? UserMapper::fromArrayToEntity($userModel->toArray()) : null;
    }

    public function updatePassword(UserEntity $user): bool
    {
        return UserModel::where('id', $user->getId())->update(['password' => $user->getPasswordValue()]);
    }

    public function updateProfile(UserEntity $user): bool
    {
        return UserModel::where('id', $user->getId())->update([
            'name' => $user->getProfileName(),
            'surname' => $user->getProfileSurname(),
        ]);
    }

    /*
    public function createPasswordResetToken(User $user): string
    {
        return Password::createToken($user);
    }
    */
}
