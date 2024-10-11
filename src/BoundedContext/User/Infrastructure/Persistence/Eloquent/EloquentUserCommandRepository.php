<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\User\Domain\Contract\UserCommandRepositoryInterface;
use App\BoundedContext\User\Infrastructure\Model\UserModel;
use App\BoundedContext\User\Domain\Entity\User;

class EloquentUserCommandRepository implements UserCommandRepositoryInterface
{

    private UserModel $model;

    public function __construct(UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function updatePassword(User $user): bool
    {
        return $this->model::where('id', $user->getId())->update(['password' => $user->getPassword()->value()]);
    }

    public function updateProfile(User $user): bool
    {
        return $this->model::where('id', $user->getId()->value())->update([
            'name' => $user->getProfile()->getName()->value(),
            'surname' => $user->getProfile()->getSurname()->value(),
        ]);
    }

    public function create(User $user): User
    {
        return $user;
    }
}
