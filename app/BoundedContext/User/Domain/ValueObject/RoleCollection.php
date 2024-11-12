<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\BoundedContext\User\Domain\Entity\Role;
use App\BoundedContext\User\Domain\Exception\RoleAlreadyExistsException;
use App\Shared\Domain\Collection\Collection;

class RoleCollection extends Collection
{
    /**
     * @param Role[] $roles
     */
    public function __construct(array $roles)
    {
        parent::__construct($roles);
    }

    public function add(Role $role): void
    {
        if ($this->has($role)) {
            throw new RoleAlreadyExistsException();
        }
        $this->items[] = $role;
    }

    public function has(Role $role): bool
    {
        foreach ($this->items as $existingRole) {
            if ($existingRole->getName() === $role->getName()) {
                return true;
            }
        }
        return false;
    }

    public function toArray(): array
    {
        return array_map(fn(Role $role) => $role->getName(), $this->items);
    }
}
