<?php

namespace App\Domain\Auth\Services;

use App\Domain\Users\Http\Resources\UserResource;
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
