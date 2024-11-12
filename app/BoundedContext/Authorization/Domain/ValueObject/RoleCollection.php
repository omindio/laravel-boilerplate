<?php

namespace App\BoundedContext\Authorization\Domain\ValueObject;

use App\BoundedContext\Authorization\Domain\Entity\Role;
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
        return array_map(function (Role $role) {
            return [
                'id' => $role->getId()->value(),
                'name' => $role->getName()->value(),
            ];
        }, $this->items);
    }
}
