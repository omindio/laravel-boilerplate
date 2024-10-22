<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent\Mapper;

use App\BoundedContext\Authentication\Application\Contract\UserDatabaseMapperInterface;
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

class EloquentUserDatabaseMapper implements UserDatabaseMapperInterface
{
    public function toModel(User $user): UserModel
    {
        $model = new UserModel();
        $model->id = $user->getId()->value();
        $model->email = $user->getEmail()->value();

        return $model;
    }

    public function toEntity(object $userModel): User
    {
        if (!$userModel instanceof UserModel) {
            throw new \InvalidArgumentException('Expected instance of UserModel');
        }

        $roles = $userModel->roles->pluck('name')->map(fn($name) => new Role($name))->toArray();
        $permissions = $userModel->permissions->pluck('name')->map(fn($name) => new Permission($name))->toArray();

        return new User(
            new UserId($userModel->id),
            new UserName($userModel->name),
            new Email($userModel->email),
            new Password($userModel->password, true),
            new RoleCollection($roles),
            new PermissionCollection($permissions),
        );
    }
}
