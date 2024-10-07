<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Exceptions\BaseException;
use App\Shared\Http\HttpStatusCodes;

class InvalidPasswordException extends BaseException
{
    public function __construct($message = "La nueva contraseña no es suficientemente fuerte.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
    }
}
