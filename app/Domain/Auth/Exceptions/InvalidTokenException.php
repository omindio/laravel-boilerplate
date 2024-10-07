<?php

namespace App\Domain\Auth\Exceptions;

use App\Shared\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response;

class InvalidTokenException extends BaseException
{
    public function __construct($message = "El token de restablecimiento de contraseña es inválido o ha expirado.")
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}
