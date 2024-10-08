<?php

namespace App\Domain\Auth\Http\Controllers;

use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Auth\Services\AuthService;
use App\Infrastructure\Http\Responses\ApiSuccessResponse;

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
