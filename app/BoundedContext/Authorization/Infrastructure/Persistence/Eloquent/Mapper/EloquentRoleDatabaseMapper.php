<?php

namespace App\BoundedContext\Authorization\Infrastructure\Persistence\Eloquent\Mapper;

use App\BoundedContext\Authorization\Application\Contract\RoleDatabaseMapperInterface;
use App\BoundedContext\Authorization\Domain\Entity\Role;
use App\BoundedContext\Authorization\Domain\ValueObject\RoleName;
use App\Shared\Domain\ValueObject\Id;
use Spatie\Permission\Models\Role as RoleModel;

class EloquentRoleDatabaseMapper implements RoleDatabaseMapperInterface
{
    public function toModel(Role $role): RoleModel
    {
        $model = new RoleModel();
        $model->id = $role->getId() ? $role->getId()->value() : null;
        $model->name = $role->getName()->value();

        return $model;
    }

    public function toEntity(object $roleModel): Role
    {
        if (!$roleModel instanceof RoleModel) {
            throw new \InvalidArgumentException('Expected instance of UserModel');
        }

        return new Role(
            new RoleName($roleModel->name),
            new Id($roleModel->id),
        );
    }
}
