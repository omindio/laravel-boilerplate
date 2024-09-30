<?php

namespace App\Domains\Auth\Controllers;

use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Domains\Auth\Notifications\ResetPasswordNotification;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Http;
use App\Shared\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'captchaToken' => 'required|string'
        ]);

        $secret = config('services.hcaptcha.secret');

        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => $secret,
            'response' => $request->captchaToken,
            'remoteip' => $request->ip(),
        ]);

        $responseData = $response->json();

        if (!$responseData['success']) {
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
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

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
