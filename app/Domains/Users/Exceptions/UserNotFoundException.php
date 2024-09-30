<?php

namespace App\Domains\Users\Exceptions;

use App\Shared\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response; // Para los códigos de estado HTTP

class UserNotFoundException extends BaseException
{
    public function __construct($message = "Usuario no encontrado.")
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
