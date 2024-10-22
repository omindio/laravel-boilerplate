<?php

namespace App\BoundedContext\Authentication\Presentation\Controller;

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

            $response = $this->commandBus->dispatch($requestPasswordReset);

            return $this->successResponse('El cambio de contraseña ha sido procesado correctamente. Hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico.', $response->toArray());
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            //$this->forgotPasswordService->resetPassword($request);
            //return ApiSuccessResponse::send([], 'La contraseña se ha actualizado correctamente.');
        } catch (BaseException $e) {
            //return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
