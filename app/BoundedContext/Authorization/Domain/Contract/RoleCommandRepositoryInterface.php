<?php

namespace App\BoundedContext\Authorization\Domain\Contract;

use App\BoundedContext\Authorization\Domain\Entity\Role;

interface RoleCommandRepositoryInterface
{
    public function create(Role $role): Role;
    public function update(Role $role): bool;
    public function delete(Role $role): bool;
}
