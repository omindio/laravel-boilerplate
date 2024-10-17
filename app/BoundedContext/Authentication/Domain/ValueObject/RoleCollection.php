<?php

namespace App\BoundedContext\Authentication\Domain\ValueObject;

use App\BoundedContext\Authentication\Domain\Entity\Role;

class RoleCollection
{
    /** @var Role[] */
    private array $roles;

    /**
     * @param Role[] $roles
     */
    public function __construct(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return Role[]
     */
    public function all(): array
    {
        return $this->roles;
    }

    public function toArray(): array
    {
        return array_map(fn(Role $role) => $role->getName(), $this->roles);
    }
}
