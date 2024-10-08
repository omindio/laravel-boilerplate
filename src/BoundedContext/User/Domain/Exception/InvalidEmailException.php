<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Domain\Exceptions\BaseException;
use App\Shared\Domain\Exceptions\HttpStatusCodes;

class InvalidEmailException extends BaseException
{
    public function __construct($message = "El email introducido no es válido.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
    }
}
