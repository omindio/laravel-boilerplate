<?php

namespace App\Domains\Auth\Services;

use App\Domains\Users\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Shared\Http\Responses\ApiSuccessResponse;

class AuthService
{
    public function user()
    {
        $user = Auth::user();

        return ApiSuccessResponse::send([
            'user' => new UserResource($user),
        ]);
    }

    // public function login() {}
    // public function logout() {}
}
