<?php

namespace App\BoundedContext\Users\Http\Controllers;

use App\BoundedContext\Users\Http\Requests\UpdateProfileRequest;
use App\BoundedContext\Users\Services\ProfileService;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Responses\ApiErrorResponse;
use App\Infrastructure\Http\Responses\ApiSuccessResponse;
use App\Shared\Exceptions\BaseException;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $user = $this->profileService->update($request->user(), $request->validated());
            return ApiSuccessResponse::send($user, 'El usuario se ha actualizado correctamente.');
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }

    public function show(Request $request)
    {
        try {
            $user = $this->profileService->showByRequest($request);
            return ApiSuccessResponse::send($user);
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
