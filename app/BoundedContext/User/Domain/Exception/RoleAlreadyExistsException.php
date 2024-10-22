<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class RoleAlreadyExistsException extends BaseException
{
    public function __construct($message = "The role already exists in the collection")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
