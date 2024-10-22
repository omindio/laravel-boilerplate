<?php

namespace App\BoundedContext\Authentication\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class EmptyPasswordResetTokenException extends BaseException
{
    public function __construct($message = "El token no puede estar vacío.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
