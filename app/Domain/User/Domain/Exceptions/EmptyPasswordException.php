<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Exceptions\BaseException;
use App\Shared\Http\HttpStatusCodes;

class EmptyPasswordException extends BaseException
{
    public function __construct($message = "La contraseña actual no puede estar vacía.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
    }
}
