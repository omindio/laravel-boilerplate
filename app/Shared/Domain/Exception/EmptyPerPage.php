<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class EmptyPerPageException extends BaseException
{
    public function __construct($message = "El numero de valores por página no puede estar vacío.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
