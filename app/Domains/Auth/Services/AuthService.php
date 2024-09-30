<?php

namespace App\Domains\Auth\Services;

use App\Domains\Users\Resources\UserResource;
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
