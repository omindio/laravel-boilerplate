<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordNotification;
use App\Models\User;
use Illuminate\Support\Facades\Http;

//TODO: Revisar para añadir el parser de objetos para la respuesta json ejemplo el usuario que enviamos en la autenticacion tambien para otros metodos
//TODO: Añadir documentacion swagger y hacer la prueba httponly con swagger
//TODO: Añadir la gestion de try catch para cuando esten operativos servicios.
//TODO: Gestion de excepciones y de la validacion de los datos
//TODO: como se gestiona la cantida de recuperar contraseña que un usuario puede enviar
//TODO: Hacer directorio Auth, y añadir SpaAuthController y ForgotPasswordController
class AuthController extends Controller
{
    public function spaLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return ApiErrorResponse::send('Invalid credentials', [], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return ApiSuccessResponse::send([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'roles' => $user->roles->pluck('name'),
                'permissions' => $user->permissions->pluck('name'),
            ],
        ]);
    }

    public function spaLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ApiSuccessResponse::send([], 'Successfully logged out');
    }

    public function user()
    {
        $user = Auth::user();

        return ApiSuccessResponse::send([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'roles' => $user->roles->pluck('name'),
                'permissions' => $user->permissions->pluck('name'),
            ],
        ]);
    }

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
