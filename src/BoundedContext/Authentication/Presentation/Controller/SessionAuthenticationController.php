<?php

namespace App\BoundedContext\Authentication\Presentation\Controller;

use App\BoundedContext\Authentication\Application\Command\LoginUserSession;
use App\BoundedContext\Authentication\Application\Command\LogoutUserSession;
use App\BoundedContext\Authentication\Presentation\Request\LoginRequest;
use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Presentation\Controller;
use App\Shared\Domain\Exception\BaseException;

class SessionAuthenticationController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();

            $authenticateCommand = new LoginUserSession(
                $data['email'],
                $data['password']
            );

            $response = $this->commandBus->execute($authenticateCommand);

            return $this->successResponse('La contraseña se ha cambiado correctamente.', [$response->toArray()]);
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function logout()
    {
        try {
            $this->commandBus->execute(new LogoutUserSession());
            return $this->successResponse('Has cerrado sesión correctamente.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
