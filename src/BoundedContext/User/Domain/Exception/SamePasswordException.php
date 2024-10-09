<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Exception\BaseException;

class SamePasswordException extends BaseException
{
    public function __construct($message = "La nueva contraseña no puede ser igual a la actual.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
