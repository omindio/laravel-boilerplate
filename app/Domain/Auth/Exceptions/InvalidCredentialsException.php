<?php

namespace App\Domain\Auth\Exceptions;

use App\Shared\Exceptions\BaseException;
use Symfony\Component\HttpFoundation\Response;

class InvalidCredentialsException extends BaseException
{
    public function __construct($message = "Usuario o contraseña incorrectos.")
    {
        parent::__construct($message, Response::HTTP_UNAUTHORIZED);
    }
}
