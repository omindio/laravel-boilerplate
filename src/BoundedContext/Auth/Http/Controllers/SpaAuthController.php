<?php

namespace App\Domain\Auth\Http\Controllers;

use App\Domain\Auth\Http\Requests\LoginRequest;
use App\Domain\Auth\Services\SpaAuthService;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Responses\ApiSuccessResponse;
use App\Infrastructure\Http\Responses\ApiErrorResponse;
use App\Shared\Exceptions\BaseException;

//TODO: Añadir documentacion swagger y hacer la prueba httponly con swagger
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
        try {
            $user = $this->spaAuthService->login($request);
            return ApiSuccessResponse::send([
                'user' => $user,
            ]);
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function logout(Request $request)
    {
        $this->spaAuthService->logout($request);
        return ApiSuccessResponse::send([], 'Has cerrado sesión correctamente.');
    }
}
