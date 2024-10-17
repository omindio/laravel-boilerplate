<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\BoundedContext\Authentication\Domain\Entity\Permission;

class PermissionCollection
{
    /** @var Permission[] */
    private array $permissions;

    /**
     * @param Permission[] $permissions
     */
    public function __construct(array $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return Permission[]
     */
    public function all(): array
    {
        return $this->permissions;
    }

    public function toArray(): array
    {
        return array_map(fn(Permission $permission) => $permission->getName(), $this->permissions);
    }
}
