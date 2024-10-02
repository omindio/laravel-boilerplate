<?php

namespace App\Domains\Users\Controllers;

use App\Shared\Http\Controllers\Controller;
use App\Domains\Users\Requests\UpdatePasswordRequest;
use App\Domains\Users\Services\UpdatePasswordService;
use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;
use App\Shared\Exceptions\BaseException;

class UpdatePasswordController extends Controller
{
    protected $updatePasswordService;

    public function __construct(UpdatePasswordService $updatePasswordService)
    {
        $this->updatePasswordService = $updatePasswordService;
    }

    public function update(UpdatePasswordRequest $request)
    {
        try {
            $this->updatePasswordService->update($request->user(), $request->validated());
            return ApiSuccessResponse::send([], 'La contraseña se ha cambiado correctamente.');
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
