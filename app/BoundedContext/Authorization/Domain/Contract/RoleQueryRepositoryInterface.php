<?php

namespace App\BoundedContext\Authorization\Domain\Contract;

use App\BoundedContext\Authorization\Domain\Entity\Role;
use App\BoundedContext\Authorization\Domain\ValueObject\RoleName;
use App\Shared\Domain\Contract\PaginatorInterface;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\Page;
use App\Shared\Domain\ValueObject\PerPage;

interface RoleQueryRepositoryInterface
{
    public function findById(Id $id): ?Role;
    public function findByName(RoleName $name): ?Role;
    public function findAll(?Page $page, ?PerPage $perPage): PaginatorInterface;
}
