<?php

namespace App\Shared\Infrastructure\Bus\Exception;

use App\Shared\Domain\Exception\BaseException;

class HandlerNotFoundException extends BaseException
{
    public function __construct($message = "Handler not found.")
    {
        parent::__construct($message, self::HTTP_NOT_FOUND);
    }
}
