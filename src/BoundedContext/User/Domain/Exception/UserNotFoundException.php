<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class UserNotFoundException extends BaseException
{
    public function __construct($message = "Usuario no encontrado.")
    {
        parent::__construct($message, self::HTTP_NOT_FOUND);
    }
}
