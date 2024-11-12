<?php

namespace App\BoundedContext\Authorization\Application\Command;

use App\BoundedContext\Authorization\Application\Command\DeleteRole;
use App\BoundedContext\Authorization\Application\Service\RoleService;
use App\Shared\Domain\ValueObject\Id;

class DeleteRoleHandler
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function handle(DeleteRole $command): void
    {
        $id = new Id($command->getId());

        $this->roleService->delete(
            $id
        );
    }
}
