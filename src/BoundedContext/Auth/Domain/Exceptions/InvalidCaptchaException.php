<?php

namespace App\BoundedContext\Auth\Exceptions;

use App\Shared\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response;

class InvalidCaptchaException extends BaseException
{
    public function __construct($message = "Error en la validación de captcha.")
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}
