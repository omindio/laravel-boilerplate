<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Domain\Contract\UserCommandRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\BoundedContext\Authentication\Domain\Entity\User;

class EloquentUserCommandRepository implements UserCommandRepositoryInterface
{

    private UserModel $model;

    public function __construct(UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function updatePassword(User $user): bool
    {
        return $this->model::where('id', $user->getId()->value())->update(['password' => $user->getPassword()->value()]);
    }
}
