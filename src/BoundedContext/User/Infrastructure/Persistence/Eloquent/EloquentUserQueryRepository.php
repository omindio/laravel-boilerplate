<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\User\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\User\Infrastructure\Model\UserModel;
use App\BoundedContext\User\Domain\Entity\User;
use App\BoundedContext\User\Domain\ValueObject\Email;
use App\BoundedContext\User\Domain\ValueObject\Id;
use App\BoundedContext\User\Infrastructure\Mapper\UserDatabaseMapper;

class EloquentUserQueryRepository implements UserQueryRepositoryInterface
{
    private UserModel $model;

    public function __construct(UserModel $userModel)
    {
        $this->model = $userModel;
    }

    public function findById(Id $id): ?User
    {
        $userModel = $this->model::find($id->value());
        return $userModel ? UserDatabaseMapper::toDomain($userModel) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $userModel = $this->model::where('email', $email->value())->first();
        return $userModel ? UserDatabaseMapper::toDomain($userModel) : null;
    }
}
