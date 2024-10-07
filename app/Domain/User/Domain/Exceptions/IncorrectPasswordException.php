<?php

namespace App\Domain\User\Domain\Exceptions;

use App\Shared\Exceptions\BaseException;
use App\Shared\Http\HttpStatusCodes;

class IncorrectPasswordException extends BaseException
{
    public function __construct($message = "Current password is incorrect.")
    {
        parent::__construct($message, HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);
    }
}
