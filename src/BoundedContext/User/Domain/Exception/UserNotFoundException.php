<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Domain\Exceptions\BaseException;
use App\Shared\Domain\Exceptions\HttpStatusCodes;

class UserNotFoundException extends BaseException
{
    public function __construct($message = "Usuario no encontrado.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_NOT_FOUND);
    }
}
