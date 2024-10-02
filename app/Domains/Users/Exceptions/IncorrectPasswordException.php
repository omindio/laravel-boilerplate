<?php

namespace App\Domains\Users\Exceptions;

use App\Shared\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response;

class IncorrectPasswordException extends BaseException
{
    public function __construct($message = "Current password is incorrect.")
    {
        parent::__construct($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
