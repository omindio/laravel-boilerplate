<?php

namespace App\BoundedContext\User\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authorization\Application\Contract\RoleDatabaseMapperInterface;
use App\BoundedContext\Authorization\Domain\Contract\RoleCommandRepositoryInterface;
use App\BoundedContext\Authorization\Domain\Entity\Role;
use App\Shared\Domain\ValueObject\Id;
use Spatie\Permission\Models\Role as RoleModel;

class EloquentRoleCommandRepository implements RoleCommandRepositoryInterface
{
    private RoleModel $model;
    private RoleDatabaseMapperInterface $mapper;

    public function __construct(RoleModel $roleModel, RoleDatabaseMapperInterface $roleDatabaseMapper)
    {
        $this->model = $roleModel;
        $this->mapper = $roleDatabaseMapper;
    }

    public function create(Role $role): Role
    {
        $roleModel = $this->mapper->toModel($role);
        $roleModel->save();

        $role->setId(new Id($roleModel->id));

        return $role;
    }

    public function update(Role $role): bool
    {
        return $this->model::where('id', $role->getId()->value())->update([
            'name' => $role->getName()->value(),
        ]);
    }

    public function delete(Role $role): bool
    {
        $roleModel = $this->model::find($role->getId()->value());

        if (!$roleModel) {
            return false;
        }

        if ($roleModel->users()->count() > 0) {
            return false;
        }

        return $roleModel->delete();
    }
}
