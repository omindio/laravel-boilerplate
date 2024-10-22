<?php

namespace App\Shared\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class EmptyCaptchaTokenException extends BaseException
{
    public function __construct($message = "Captcha token cannot be empty.")
    {
        parent::__construct($message, self::HTTP_UNPROCESSABLE_ENTITY);
    }
}
