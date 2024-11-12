<?php

namespace App\BoundedContext\Authorization\Application\Service;

use App\BoundedContext\Authorization\Domain\Contract\RoleCommandRepositoryInterface;
use App\BoundedContext\Authorization\Domain\Contract\RoleQueryRepositoryInterface;
use App\BoundedContext\Authorization\Domain\Entity\Role;
use App\BoundedContext\Authorization\Domain\Exception\RoleAlreadyExistsException;
use App\BoundedContext\Authorization\Domain\Exception\RoleAssociatedWithUsersException;
use App\BoundedContext\Authorization\Domain\Exception\RoleNotFoundException;
use App\BoundedContext\Authorization\Domain\ValueObject\RoleName;
use App\Shared\Domain\Contract\PaginatorInterface;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\Page;
use App\Shared\Domain\ValueObject\PerPage;

class RoleService
{
    private RoleCommandRepositoryInterface $roleCommandRepository;
    private RoleQueryRepositoryInterface $roleQueryRepository;

    public function __construct(RoleQueryRepositoryInterface $roleQueryRepository, RoleCommandRepositoryInterface $roleCommandRepository)
    {
        $this->roleQueryRepository = $roleQueryRepository;
        $this->roleCommandRepository = $roleCommandRepository;
    }

    public function create(RoleName $name): Role
    {
        $roleExists = $this->roleQueryRepository->findByName($name);

        if ($roleExists) {
            throw new RoleAlreadyExistsException();
        }

        $newRole = new role($name);

        return $this->roleCommandRepository->create($newRole);
    }

    public function update(Id $id, RoleName $name): Role
    {
        $role = $this->roleQueryRepository->findById($id);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        $roleExists = $this->roleQueryRepository->findByName($name);

        if ($roleExists) {
            throw new RoleAlreadyExistsException();
        }

        $role->setName($name);
        $this->roleCommandRepository->update($role);

        return $role;
    }

    public function delete(Id $id): void
    {
        $role = $this->roleQueryRepository->findById($id);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        if (!$this->roleCommandRepository->delete($role)) {
            throw new RoleAssociatedWithUsersException();
        }
    }

    public function findAll(?Page $page, ?PerPage $perPage): PaginatorInterface
    {
        return $this->roleQueryRepository->findAll($page, $perPage);
    }
}
