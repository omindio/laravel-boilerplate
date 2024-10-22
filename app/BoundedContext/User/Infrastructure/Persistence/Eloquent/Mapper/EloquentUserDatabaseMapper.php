<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent\Mapper;

use App\BoundedContext\User\Application\Contract\UserDatabaseMapperInterface;
use App\BoundedContext\User\Domain\Entity\User;
use App\BoundedContext\User\Domain\ValueObject\Name;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\ValueObject\UserId;
use App\BoundedContext\User\Domain\ValueObject\Profile;
use App\BoundedContext\User\Domain\ValueObject\Surname;
use App\BoundedContext\User\Domain\Entity\Role;
use App\BoundedContext\User\Domain\Entity\Permission;
use App\BoundedContext\User\Domain\ValueObject\PermissionCollection;
use App\BoundedContext\User\Domain\ValueObject\RoleCollection;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;

class EloquentUserDatabaseMapper implements UserDatabaseMapperInterface
{
    public function toEntity(object $userModel): User
    {
        if (!$userModel instanceof UserModel) {
            throw new \InvalidArgumentException('Expected instance of UserModel');
        }

        $roles = $userModel->roles->pluck('name')->map(fn($name) => new Role($name))->toArray();
        $permissions = $userModel->permissions->pluck('name')->map(fn($name) => new Permission($name))->toArray();

        return new User(
            new UserId($userModel->id),
            new Profile(new Name($userModel->name), new Surname($userModel->surname)),
            new Email($userModel->email),
            new Password($userModel->password, true),
            new RoleCollection($roles),
            new PermissionCollection($permissions),
            $userModel->created_at
        );
    }
}
