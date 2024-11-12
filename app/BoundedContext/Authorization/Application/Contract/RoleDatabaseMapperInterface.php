<?php

namespace App\BoundedContext\Authorization\Application\Contract;

use App\BoundedContext\Authorization\Domain\Entity\Role;

interface RoleDatabaseMapperInterface
{
    public function toModel(Role $role): object;
    public function toEntity(object $roleModel): Role;
}
