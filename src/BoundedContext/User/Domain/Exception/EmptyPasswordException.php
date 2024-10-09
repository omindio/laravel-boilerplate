<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Exception\BaseException;

class EmptyPasswordException extends BaseException
{
    public function __construct($message = "La contraseña actual no puede estar vacía.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
