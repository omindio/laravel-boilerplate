<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;

class EloquentUserDatabaseMapper
{
    public static function toDomain(UserModel $model): User
    {
        return new User(
            new UserId($model->id),
            new Email($model->email),
            new Password($model->password, true),
            $model->createdAt,
            $model->roles,
            $model->permissions,
        );
    }
}
