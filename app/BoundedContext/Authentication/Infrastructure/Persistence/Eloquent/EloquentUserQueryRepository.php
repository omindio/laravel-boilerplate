<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent\EloquentUserDatabaseMapper;

class EloquentUserQueryRepository implements UserQueryRepositoryInterface
{
    private UserModel $model;

    public function __construct(UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function findById(UserId $id): ?User
    {
        $userModel = $this->model::find($id->value());
        return $userModel ? EloquentUserDatabaseMapper::toDomain($userModel) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $userModel = $this->model::where('email', $email->value())->first();
        return $userModel ? EloquentUserDatabaseMapper::toDomain($userModel) : null;
    }
}
