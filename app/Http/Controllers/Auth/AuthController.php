<?php

namespace App\Http\Controllers\Auth;

use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
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

    // public function logout() {}

    // public function login() {}
}
