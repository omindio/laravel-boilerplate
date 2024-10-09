<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Exception\BaseException;

class InvalidEmailException extends BaseException
{
    public function __construct($message = "El email introducido no es válido.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
