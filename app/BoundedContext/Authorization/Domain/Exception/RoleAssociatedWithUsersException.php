<?php

namespace App\BoundedContext\Authorization\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class RoleAssociatedWithUsersException extends BaseException
{
    public function __construct($message = "Role is associated with users and cannot be deleted.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
