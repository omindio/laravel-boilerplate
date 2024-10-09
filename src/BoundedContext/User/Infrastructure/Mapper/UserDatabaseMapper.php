<?php

namespace App\BoundedContext\User\Infrastructure\Mapper;

use App\BoundedContext\User\Domain\Entity\User;
use App\BoundedContext\User\Domain\ValueObject\Email;
use App\BoundedContext\User\Domain\ValueObject\Password;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\BoundedContext\User\Infrastructure\Model\UserModel;
use App\BoundedContext\User\Domain\ValueObject\Id;

class UserDatabaseMapper
{
    public static function toDomain(UserModel $model): User
    {
        return new User(
            new Id($model->id),
            new Profile($model->name, $model->surname),
            new Email($model->email),
            isset($model->password) ? new Password($model->password, true) : null,
            $model->createdAt,
            $model->roles,
            $model->permissions,
        );
    }
}
