<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Exception\BaseException;

class InvalidPasswordException extends BaseException
{
    public function __construct($message = "La nueva contraseña no es suficientemente fuerte.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
