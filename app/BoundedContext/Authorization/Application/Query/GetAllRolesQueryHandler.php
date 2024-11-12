<?php

namespace App\BoundedContext\Authorization\Application\Query;

use App\BoundedContext\Authorization\Application\Response\GetAllRolesResponse;
use App\BoundedContext\Authorization\Application\Service\RoleService;

class GetAllRolesQueryHandler
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function handle(GetAllRolesQuery $query)
    {
        $page = $query->getPage();
        $perPage = $query->getPerPage();

        $roles = $this->roleService->findAll(
            $page,
            $perPage,
        );

        return new GetAllRolesResponse(
            $roles->items()->toArray(),
            $roles->currentPage(),
            $roles->lastPage(),
            $roles->perPage(),
            $roles->total()
        );
    }
}
