<?php

namespace App\BoundedContext\Authorization\Presentation\Controller;

use App\BoundedContext\Authentication\Application\Query\GetUserAuthenticated;
use App\BoundedContext\Authorization\Application\Command\CreateRole;
use App\BoundedContext\Authorization\Application\Command\DeleteRole;
use App\BoundedContext\Authorization\Application\Command\UpdateRole;
use App\BoundedContext\Authorization\Application\Query\GetAllRolesQuery;
use App\BoundedContext\Authorization\Presentation\Request\CreateRoleRequest;
use App\BoundedContext\Authorization\Presentation\Request\DeleteRoleRequest;
use App\BoundedContext\Authorization\Presentation\Request\GetAllRolesRequest;
use App\BoundedContext\Authorization\Presentation\Request\UpdateRoleRequest;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Application\Contract\QueryBusInterface;
use App\Shared\Presentation\Controller;
use App\Shared\Domain\Exception\BaseException;

class RoleController extends Controller
{

    private QueryBusInterface $queryBus;
    private CommandBusInterface $commandBus;

    public function __construct(QueryBusInterface $queryBus, CommandBusInterface $commandBus)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    public function create(CreateRoleRequest $request)
    {
        try {
            $data = $request->validated();

            $createRoleCommand = new CreateRole($data['name']);

            $response = $this->commandBus->dispatch($createRoleCommand);

            return $this->successResponse('Role añadido corretamente.', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function update(UpdateRoleRequest $request)
    {
        try {
            $data = $request->validated();

            $updateRoleCommand = new UpdateRole($data['id'], $data['name']);

            $response = $this->commandBus->dispatch($updateRoleCommand);

            return $this->successResponse('Role actualizado correctamente.', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function delete(DeleteRoleRequest $request)
    {
        try {
            $data = $request->validated();

            $deleteRoleCommand = new DeleteRole($data['id']);

            $this->commandBus->dispatch($deleteRoleCommand);

            return $this->successResponse('Role eliminado correctamente.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function getAll(GetAllRolesRequest $request)
    {
        try {
            $data = $request->validated();

            $getAllRolesQuery = new GetAllRolesQuery($data['page'], $data['perPage']);

            $response = $this->queryBus->ask($getAllRolesQuery);

            return $this->successResponse('', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
