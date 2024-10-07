<?php

namespace App\Domain\Auth\Http\Controllers;

use App\Domain\Auth\Http\Requests\ForgotPasswordRequest;
use App\Domain\Auth\Http\Requests\ResetPasswordRequest;
use App\Domain\Auth\Services\ForgotPasswordService;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Responses\ApiErrorResponse;
use App\Infrastructure\Http\Responses\ApiSuccessResponse;
use App\Shared\Exceptions\BaseException;

class ForgotPasswordController extends Controller
{
    protected $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $this->forgotPasswordService->forgotPassword($request);
            return ApiSuccessResponse::send([], 'La solicitud ha sido procesada correctamente. Hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico.');
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $this->forgotPasswordService->resetPassword($request);
            return ApiSuccessResponse::send([], 'La contraseña se ha actualizado correctamente.');
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
