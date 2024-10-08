<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Domain\Exceptions\BaseException;
use App\Shared\Domain\Exceptions\HttpStatusCodes;

class IncorrectPasswordException extends BaseException
{
    public function __construct($message = "Current password is incorrect.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
    }
}
