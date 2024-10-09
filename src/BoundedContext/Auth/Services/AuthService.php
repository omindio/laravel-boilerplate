<?php

namespace App\BoundedContext\Auth\Services;

use App\BoundedContext\Users\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function user()
    {
        $user = Auth::user();

        return new UserResource($user);
    }

    // public function login() {}
    // public function logout() {}
}
