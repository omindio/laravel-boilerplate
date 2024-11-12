<?php

namespace App\BoundedContext\Authorization\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class RoleAlreadyExistsException extends BaseException
{
    public function __construct($message = "Este rol ya existe.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
