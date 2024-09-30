<?php

namespace App\Domains\Auth\Services;

use App\Domains\Users\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;

class SpaAuthService
{
    public function login(Request $request)
    {
        if (!Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return ApiErrorResponse::send('Invalid credentials', [], 401);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return ApiSuccessResponse::send([
            'user' => new UserResource($user),
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
