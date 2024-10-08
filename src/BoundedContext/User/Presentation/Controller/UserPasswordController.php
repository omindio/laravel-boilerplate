<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\User\Application\DTOs\UpdatePasswordDTO;
use App\Shared\Controllers\Controller;
use App\Domain\Users\Http\Requests\UpdatePasswordRequest;
use App\Domain\User\Application\Services\UserPasswordService;
use App\Shared\Domain\Exceptions\BaseException;

class PasswordController extends Controller
{
    protected $userPasswordService;
    protected $userMapper;

    public function __construct(UserPasswordService $userPasswordService)
    {
        $this->userPasswordService = $userPasswordService;
    }

    public function update(UpdatePasswordRequest $request)
    {
        try {
            $data = $request->validated();

            $userId = $request->user()->id;

            $updatePasswordDTO = new UpdatePasswordDTO(
                $data['currentPassword'],
                $data['newPassword'],
                $data['confirmPassword']
            );

            $this->userPasswordService->update($userId, $updatePasswordDTO);

            return $this->successResponse('La contraseña se ha cambiado correctamente.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
