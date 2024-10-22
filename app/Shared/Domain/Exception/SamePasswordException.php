<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class SamePasswordException extends BaseException
{
    public function __construct($message = "La nueva contraseña no puede ser igual a la actual.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
