<?php

namespace App\Domains\Auth\Services;

use Illuminate\Http\Request;
use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Domains\Auth\Notifications\ResetPasswordNotification;
use App\Domains\Users\Models\User;
use App\Shared\Services\CaptchaService;

class ForgotPasswordService
{
    protected $captchaService;

    public function __construct(CaptchaService $captchaService)
    {
        $this->captchaService = $captchaService;
    }

    public function forgotPassword(Request $request)
    {
        $isCaptchaValid = $this->captchaService->verify($request->captchaToken, $request->ip());

        if (!$isCaptchaValid) {
            return ApiErrorResponse::send('Error en la validación de captcha.', [], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return ApiErrorResponse::send('No se ha encontrado un usuario con ese correo electrónico.', [], 400);
        }

        $token = Password::createToken($user);
        $user->notify(new ResetPasswordNotification($token, $request->email));

        return ApiSuccessResponse::send([], 'Se ha enviado un enlace de restablecimiento de contraseña a su correo electrónico.');
    }

    public function resetPassword(Request $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        switch ($status) {
            case Password::PASSWORD_RESET:
                return ApiSuccessResponse::send([], 'La contraseña se ha restablecido correctamente.');
            case Password::INVALID_TOKEN:
                return ApiErrorResponse::send('El token de restablecimiento de contraseña es inválido o ha expirado.', [], 400);
            case Password::INVALID_USER:
                return ApiErrorResponse::send('No se ha encontrado un usuario con ese correo electrónico.', [], 400);
            default:
                return ApiErrorResponse::send(__($status), [], 400);
        }
    }
}
