<?php

namespace App\Domain\Users\Http\Controllers;

use App\Application\User\Mappers\UserMapper;
use App\Domain\User\Application\DTOs\UpdateUserPasswordDTO;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Users\Http\Requests\UpdatePasswordRequest;
use App\Domain\User\Domain\Services\UserPasswordService;
use App\Infrastructure\Http\Responses\ApiErrorResponse;
use App\Infrastructure\Http\Responses\ApiSuccessResponse;
use App\Shared\Exceptions\BaseException;

class PasswordController extends Controller
{
    protected $userPasswordService;
    protected $userMapper;

    public function __construct(UserPasswordService $userPasswordService, UserMapper $userMapper)
    {
        $this->userPasswordService = $userPasswordService;
        $this->userMapper = $userMapper;
    }

    public function update(UpdatePasswordRequest $request)
    {
        try {
            $data = $request->validated();

            $passwordDTO = new UpdateUserPasswordDTO(
                $data['currentPassword'],
                $data['newPassword'],
                $data['confirmPassword']
            );
            //TODO: verificar que se validan los datos
            $this->passwordService->update($request->user(), $request->validated());
            return ApiSuccessResponse::send([], 'La contraseña se ha cambiado correctamente.');
        } catch (BaseException $e) {
            return ApiErrorResponse::send($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
