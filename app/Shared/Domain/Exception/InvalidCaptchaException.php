<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class InvalidCaptchaException extends BaseException
{
    public function __construct($message = "Error en la validación de captcha.")
    {
        parent::__construct($message, self::HTTP_BAD_REQUEST);
    }
}
