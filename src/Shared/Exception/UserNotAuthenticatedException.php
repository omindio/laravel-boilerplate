<?php

namespace App\Shared\Exception;

use App\Shared\Exception\BaseException;

class UserNotAuthenticatedException extends BaseException
{
    public function __construct($message = "Usuario no autenticado.")
    {
        parent::__construct($message, self::HTTP_UNAUTHORIZED);
    }
}
