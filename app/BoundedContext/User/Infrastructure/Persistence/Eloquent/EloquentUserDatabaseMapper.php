<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\User\Domain\Entity\User;
use App\BoundedContext\User\Domain\ValueObject\Name;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\BoundedContext\User\Domain\ValueObject\Surname;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;

class EloquentUserDatabaseMapper
{
    public static function toDomain(UserModel $model): User
    {
        return new User(
            new UserId($model->id),
            new Profile(new Name($model->name), new Surname($model->surname)),
            new Email($model->email),
            new Password($model->password, true),
            $model->created_at,
            $model->roles->pluck('name')->toArray(),
            $model->permissions->pluck('name')->toArray(),
        );
    }
}
