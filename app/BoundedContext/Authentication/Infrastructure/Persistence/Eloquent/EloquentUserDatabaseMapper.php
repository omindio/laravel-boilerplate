<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\BoundedContext\Authentication\Domain\Entity\Role;
use App\BoundedContext\Authentication\Domain\Entity\Permission;
use App\BoundedContext\Authentication\Domain\ValueObject\PermissionCollection;
use App\BoundedContext\Authentication\Domain\ValueObject\RoleCollection;
use App\BoundedContext\Authentication\Domain\ValueObject\UserName;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;

class EloquentUserDatabaseMapper
{
    public static function toDomain(UserModel $model): User
    {
        $roles = $model->roles->pluck('name')->map(fn($name) => new Role($name))->toArray();
        $permissions = $model->permissions->pluck('name')->map(fn($name) => new Permission($name))->toArray();

        return new User(
            new UserId($model->id),
            new UserName($model->name),
            new Email($model->email),
            new Password($model->password, true),
            new RoleCollection($roles),
            new PermissionCollection($permissions),
        );
    }
}
