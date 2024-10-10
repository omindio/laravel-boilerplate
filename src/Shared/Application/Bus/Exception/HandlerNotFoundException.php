<?php

namespace App\Shared\Application\Bus\Exception;

use App\Shared\Exception\BaseException;

class HandlerNotFoundException extends BaseException
{
    public function __construct($message = "Handler not found.")
    {
        parent::__construct($message, self::HTTP_NOT_FOUND);
    }
}
