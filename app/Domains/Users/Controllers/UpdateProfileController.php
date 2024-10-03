<?php

namespace App\Domains\Users\Controllers;

use App\Domains\Users\Requests\UpdateProfileRequest;
use App\Domains\Users\Services\UpdateProfileService;
use App\Shared\Http\Controllers\Controller;
use App\Shared\Http\Responses\ApiErrorResponse;
use App\Shared\Http\Responses\ApiSuccessResponse;
use App\Shared\Exceptions\BaseException;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{
    protected $updateProfileService;

    public function __construct(UpdateProfileService $updateProfileService)
    {
        $this->updateProfileService = $updateProfileService;
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $this->updateProfileService->update($request->user(), $request->validated());
            return ApiSuccessResponse::send([], 'La contraseña se ha cambiado correctamente.');
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function show(Request $request)
    {
        try {
            $user = $this->updateProfileService->show($request->user());
            return ApiSuccessResponse::send([$user]);
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
