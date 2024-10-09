<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Infrastructure\Model\UserModel;
use App\BoundedContext\User\Domain\Entity\User;

class EloquentUserCommandRepository implements UserCommandRepositoryInterface
{

    public function updatePassword(User $user): bool
    {
        return UserModel::where('id', $user->getId())->update(['password' => $user->getPasswordValue()]);
    }

    public function updateProfile(User $user): bool
    {
        return UserModel::where('id', $user->getId())->update([
            'name' => $user->getProfileName(),
            'surname' => $user->getProfileSurname(),
        ]);
    }
}
