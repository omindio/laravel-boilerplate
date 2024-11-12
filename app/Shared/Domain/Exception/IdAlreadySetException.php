<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class IdAlreadySetException extends BaseException
{
    public function __construct($message = "El id ya existe y no puede ser cambiado.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
