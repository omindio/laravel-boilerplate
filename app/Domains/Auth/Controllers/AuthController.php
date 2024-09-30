<?php

namespace App\Domains\Auth\Controllers;

use App\Shared\Http\Controllers\Controller;
use App\Domains\Auth\Services\AuthService;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function user()
    {
        return $this->authService->user();
    }

    // public function login() {}
    // public function logout() {}

}
