<?php


namespace App\BoundedContext\Authentication\Domain\Exception;

use App\Shared\Domain\Exception\BaseException;

class InvalidTokenException extends BaseException
{
    public function __construct($message = "El token de restablecimiento de contraseña es inválido o ha expirado.")
    {
        parent::__construct($message, self::HTTP_BAD_REQUEST);
    }
}
