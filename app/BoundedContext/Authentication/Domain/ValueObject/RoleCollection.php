<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\BoundedContext\Authentication\Domain\Entity\Role;
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

    public function toArray(): array
    {
        return array_map(fn(Role $role) => $role->getName(), $this->items);
    }
}
