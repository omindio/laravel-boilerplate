<?php

namespace App\BoundedContext\Authorization\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class RoleNotFoundException extends BaseException
{
    public function __construct($message = "Rol no encontrado.")
    {
        parent::__construct($message, self::HTTP_NOT_FOUND);
    }
}
