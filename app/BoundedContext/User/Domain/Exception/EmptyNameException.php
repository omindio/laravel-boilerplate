<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class EmptyNameException extends BaseException
{
    public function __construct($message = "El nombre no puede estar vacío.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
