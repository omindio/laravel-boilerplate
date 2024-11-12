<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\BoundedContext\Authentication\Domain\Entity\Permission;
use App\Shared\Domain\Collection\Collection;

class PermissionCollection extends Collection
{
    /**
     * @param Permission[] $permissions
     */
    public function __construct(array $permissions)
    {
        parent::__construct($permissions);
    }

    public function toArray(): array
    {
        return array_map(fn(Permission $permission) => $permission->getName(), $this->items);
    }
}
