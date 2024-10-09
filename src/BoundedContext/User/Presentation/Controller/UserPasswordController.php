<?php

namespace App\BoundedContext\Users\Http\Controllers;

use App\BoundedContext\User\Presentation\Request\UpdatePasswordRequest;
use App\BoundedContext\User\Application\Command\UpdateUserPasswordCommand;
use App\Shared\Exception\BaseException;
use App\Shared\Presentation\Controller;

class PasswordController extends Controller
{

    public function update(UpdatePasswordRequest $request)
    {
        try {
            $data = $request->validated();

            $userId = $request->user()->id;

            $updatePasswordCommand = new UpdateUserPasswordCommand(
                $userId,
                $data['currentPassword'],
                $data['newPassword'],
            );

            //handle command from bus

            return $this->successResponse('La contraseña se ha cambiado correctamente.');
        } catch (BaseException $e) {
            return $this->errorResponse($e->getMessage(), [], $e->getStatusCode());
        }
    }
}
