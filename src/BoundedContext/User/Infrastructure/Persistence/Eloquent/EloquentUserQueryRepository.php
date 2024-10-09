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
    public function findById(Id $id): ?User
    {
        $userModel = UserModel::find($id->value());
        return $userModel ? UserDatabaseMapper::toDomain($userModel) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $userModel = UserModel::where('email', $email->value())->first();
        return $userModel ? UserDatabaseMapper::toDomain($userModel) : null;
    }
}
