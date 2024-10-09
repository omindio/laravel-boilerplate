<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Exception\BaseException;

class IncorrectPasswordException extends BaseException
{
    public function __construct($message = "Current password is incorrect.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
