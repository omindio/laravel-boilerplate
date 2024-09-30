<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Exceptions\InvalidCredentialsException;
use App\Domains\Users\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SpaAuthService
{
    public function login(Request $request)
    {
        if (!Auth::guard('web')->attempt($request->only('email', 'password'))) {
            throw new InvalidCredentialsException();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
