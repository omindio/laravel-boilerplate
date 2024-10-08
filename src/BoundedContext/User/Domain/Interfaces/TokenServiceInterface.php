<?php

namespace App\Domain\User\Domain\Interfaces;

interface TokenServiceInterface
{
    public function generateToken(): string;
}
