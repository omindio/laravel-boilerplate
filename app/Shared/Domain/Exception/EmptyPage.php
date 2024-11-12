<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class EmptyPageException extends BaseException
{
    public function __construct($message = "El numero de página no puede estar vacío.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
