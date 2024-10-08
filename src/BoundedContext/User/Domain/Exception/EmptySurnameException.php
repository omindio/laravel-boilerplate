<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Domain\Exceptions\BaseException;
use App\Shared\Domain\Exceptions\HttpStatusCodes;

class EmptySurnameException extends BaseException
{
    public function __construct($message = "El apellido no puede estar vacío.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
    }
}
