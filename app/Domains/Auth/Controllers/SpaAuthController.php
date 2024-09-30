<?php

namespace App\Domains\Auth\Controllers;

use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shared\Http\Controllers\Controller;

//TODO: Revisar para añadir el parser de objetos para la respuesta json ejemplo el usuario que enviamos en la autenticacion tambien para otros metodos
//TODO: Añadir documentacion swagger y hacer la prueba httponly con swagger
//TODO: Añadir la gestion de try catch para cuando esten operativos servicios.
//TODO: Gestion de excepciones y de la validacion de los datos
//TODO: Controlar si numero solicitudes de login supera 4 enviar captcha
class SpaAuthController extends Controller
{
    public function login(Request $request)
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

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ApiSuccessResponse::send([], 'Successfully logged out');
    }
}
