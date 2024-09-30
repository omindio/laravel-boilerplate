<?php

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Requests\ForgotPasswordRequest;
use App\Domains\Auth\Requests\ResetPasswordRequest;
use App\Domains\Auth\Services\ForgotPasswordService;
use App\Shared\Http\Controllers\Controller;
use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;
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
