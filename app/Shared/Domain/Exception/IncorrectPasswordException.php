<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class IncorrectPasswordException extends BaseException
{
    public function __construct($message = "Current password is incorrect.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
