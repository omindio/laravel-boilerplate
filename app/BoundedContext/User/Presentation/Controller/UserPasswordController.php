<?php

namespace App\BoundedContext\User\Presentation\Controller;

use App\BoundedContext\User\Presentation\Request\UpdatePasswordRequest;
use App\BoundedContext\User\Application\Command\UpdateUserPassword;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Domain\Exception\BaseException;
use App\Shared\Presentation\Controller;

class UserPasswordController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function update(UpdatePasswordRequest $request)
    {
        try {
            $data = $request->validated();

            $userId = $this->authenticatedId();

            $updatePasswordCommand = new UpdateUserPassword(
                $userId,
                $data['currentPassword'],
                $data['newPassword'],
            );

            $this->commandBus->dispatch($updatePasswordCommand);

            return $this->successResponse('La contraseña se ha cambiado correctamente.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
