<?php

namespace App\BoundedContext\Authorization\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authorization\Application\Contract\RoleDatabaseMapperInterface;
use App\BoundedContext\Authorization\Domain\Contract\RoleQueryRepositoryInterface;
use App\BoundedContext\Authorization\Domain\Entity\Role;
use App\BoundedContext\Authorization\Domain\ValueObject\RoleCollection;
use App\BoundedContext\Authorization\Domain\ValueObject\RoleName;
use App\Shared\Domain\Contract\PaginatorInterface;
use App\Shared\Domain\ValueObject\Id;
use App\Shared\Domain\ValueObject\Page;
use App\Shared\Domain\ValueObject\PerPage;
use App\Shared\Infrastructure\Persistence\Eloquent\EloquentPaginator;
use Spatie\Permission\Models\Role as RoleModel;

class EloquentRoleQueryRepository implements RoleQueryRepositoryInterface
{
    private RoleModel $model;
    private RoleDatabaseMapperInterface $mapper;

    public function __construct(RoleModel $roleModel, RoleDatabaseMapperInterface $roleDatabaseMapper)
    {
        $this->model = $roleModel;
        $this->mapper = $roleDatabaseMapper;
    }

    public function findAll(?Page $page, ?PerPage $perPage): PaginatorInterface
    {
        $query = $this->model::query();

        $paginator = $query->paginate($perPage ? $perPage->value() : null, ['*'], 'page', $page ? $page->value() : null);
        $roles = collect($paginator->items())->map(function ($roleModel) {
            return $this->mapper->toEntity($roleModel);
        })->toArray();

        $rolesCollection = new RoleCollection($roles);

        return new EloquentPaginator($paginator, $rolesCollection);
    }

    public function findById(Id $id): ?Role
    {
        $roleModel = $this->model::find($id->value());
        return $roleModel ? $this->mapper->toEntity($roleModel) : null;
    }

    public function findByName(RoleName $name): ?Role
    {
        $roleModel = $this->model::where('name', $name->value())->first();
        return $roleModel ? $this->mapper->toEntity($roleModel) : null;
    }
}
