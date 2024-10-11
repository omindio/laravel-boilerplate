<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class EmptySurnameException extends BaseException
{
    public function __construct($message = "El apellido no puede estar vacío.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
