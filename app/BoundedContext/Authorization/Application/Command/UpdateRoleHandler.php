<?php

namespace App\BoundedContext\Authorization\Application\Command;

use App\BoundedContext\Authorization\Application\Command\UpdateRole;
use App\BoundedContext\Authorization\Application\Response\RoleResponse;
use App\BoundedContext\Authorization\Application\Service\RoleService;
use App\BoundedContext\Authorization\Domain\ValueObject\RoleName;

class UpdateRoleHandler
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function handle(UpdateRole $command): RoleResponse
    {
        $name = new RoleName($command->getName());

        $role = $this->roleService->create(
            $name
        );

        return new RoleResponse(
            $role->getId()->value(),
            $role->getName()->value()
        );
    }
}
