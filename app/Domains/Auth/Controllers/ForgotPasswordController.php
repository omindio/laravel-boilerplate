<?php

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Requests\ForgotPasswordRequest;
use App\Domains\Auth\Requests\ResetPasswordRequest;
use App\Domains\Auth\Services\ForgotPasswordService;
use App\Shared\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    protected $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        return $this->forgotPasswordService->forgotPassword($request);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->forgotPasswordService->resetPassword($request);
    }
}
