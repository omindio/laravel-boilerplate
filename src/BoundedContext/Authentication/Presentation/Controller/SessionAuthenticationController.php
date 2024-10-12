<?php

namespace App\BoundedContext\Authentication\Presentation\Controller;

use App\BoundedContext\Authentication\Application\Command\AuthenticateUserSession;
use App\BoundedContext\Authentication\Presentation\Request\LoginRequest;
use Illuminate\Http\Request;
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

            $authenticateCommand = new AuthenticateUserSession(
                $data['email'],
                $data['password']
            );

            $response = $this->commandBus->execute($authenticateCommand);

            return $this->successResponse('La contraseña se ha cambiado correctamente.', [$response->toArray()]);
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function logout(Request $request)
    {
        return $this->successResponse('Has cerrado sesión correctamente.');
    }
}
