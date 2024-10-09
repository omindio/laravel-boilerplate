<?php

namespace App\BoundedContext\User\Domain\Exception;

use App\Shared\Exception\BaseException;

class InvalidIdException extends BaseException
{
    public function __construct($message = "User ID must be a positive integer.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
