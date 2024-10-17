<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\User\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;

class EloquentUserDatabaseMapper
{
    public static function toDomain(UserModel $model): User
    {
        return new User(
            new UserId($model->id),
            new Profile($model->name, $model->surname),
            new Email($model->email),
            new Password($model->password, true),
            $model->createdAt,
            $model->roles,
            $model->permissions,
        );
    }
}
