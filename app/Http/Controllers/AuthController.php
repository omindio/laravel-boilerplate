<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

//TODO: Controlar el error de si no se envía el csrf token
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
            ],
            'roles' => $user->roles->pluck('name'),
            'permissions' => $user->permissions->pluck('name'),
        ]);
    }

    public function spaLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ApiSuccessResponse::send('Successfully logged out');
    }

    public function user()
    {
        $user = Auth::user();

        return ApiSuccessResponse::send([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ],
            'roles' => $user->roles->pluck('name'),
            'permissions' => $user->permissions->pluck('name'),
        ]);
    }
}
