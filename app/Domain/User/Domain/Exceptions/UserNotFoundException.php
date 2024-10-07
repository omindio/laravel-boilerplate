<?php

namespace App\Domain\User\Infrastructure\Exceptions;

use App\Shared\Exceptions\BaseException;
use App\Shared\Http\HttpStatusCodes;

class UserNotFoundException extends BaseException
{
    public function __construct($message = "Usuario no encontrado.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_NOT_FOUND);
    }
}
