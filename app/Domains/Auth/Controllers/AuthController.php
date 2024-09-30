<?php

namespace App\Domains\Auth\Controllers;

use App\Shared\Http\Controllers\Controller;
use App\Domains\Auth\Services\AuthService;
use App\Shared\Http\Responses\ApiSuccessResponse;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function user()
    {
        $user = $this->authService->user();

        return ApiSuccessResponse::send([
            'user' => $user,
        ]);
    }

    // public function login() {}
    // public function logout() {}

}
