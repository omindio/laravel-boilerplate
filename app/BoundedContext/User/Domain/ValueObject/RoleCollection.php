<?php

namespace App\BoundedContext\User\Domain\ValueObject;

use App\BoundedContext\User\Domain\Entity\Role;
use App\BoundedContext\User\Domain\Exception\RoleAlreadyExistsException;

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

    public function add(Role $role): void
    {
        if ($this->has($role)) {
            throw new RoleAlreadyExistsException();
        }
        $this->roles[] = $role;
    }

    public function has(Role $role): bool
    {
        foreach ($this->roles as $existingRole) {
            if ($existingRole->getName() === $role->getName()) {
                return true;
            }
        }
        return false;
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
