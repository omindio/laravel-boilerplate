<?php

namespace App\BoundedContext\Authentication\Presentation\Controller;

use App\BoundedContext\Authentication\Application\Command\PasswordReset;
use App\BoundedContext\Authentication\Application\Command\RequestPasswordReset;
use App\BoundedContext\Authentication\Presentation\Request\PasswordResetRequest;
use App\BoundedContext\Authentication\Presentation\Request\ResetPasswordRequest;

use App\Shared\Application\Contract\CommandBusInterface;
use App\Shared\Presentation\Controller;
use App\Shared\Domain\Exception\BaseException;

class PasswordResetController extends Controller
{
    private CommandBusInterface $commandBus;

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function requestPasswordReset(PasswordResetRequest $request)
    {
        try {
            $data = $request->validated();

            $requestPasswordReset = new RequestPasswordReset(
                $data['email'],
                $data['captchaToken'],
                $request->ip()
            );

            $this->commandBus->dispatch($requestPasswordReset);

            return $this->successResponse('El cambio de contraseña ha sido procesado correctamente. Hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function passwordReset(ResetPasswordRequest $request)
    {
        try {
            $data = $request->validated();

            $passwordReset = new PasswordReset($data['email'], $data['newPassword'], $data['confirmPassword'], $data['token']);

            $this->commandBus->dispatch($passwordReset);

            return $this->successResponse('La contraseña se ha actualizado correctamente.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
