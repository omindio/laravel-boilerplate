<?php

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Requests\LoginRequest;
use App\Domains\Auth\Services\SpaAuthService;
use Illuminate\Http\Request;
use App\Shared\Http\Controllers\Controller;

//TODO: Añadir documentacion swagger y hacer la prueba httponly con swagger
//TODO: Gestion de excepcioner try and catch
//TODO: Controlar si numero solicitudes de login supera 4 enviar captcha
class SpaAuthController extends Controller
{
    protected $spaAuthService;

    public function __construct(SpaAuthService $spaAuthService)
    {
        $this->spaAuthService = $spaAuthService;
    }

    public function login(LoginRequest $request)
    {
        return $this->spaAuthService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->spaAuthService->logout($request);
    }
}
