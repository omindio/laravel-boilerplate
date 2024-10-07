<?php

namespace App\Domain\User\Domain\Interfaces;

use App\Domain\User\Domain\ValueObjects\PasswordValueObject;

interface PasswordServiceInterface
{
    public function hash(string $plainPassword): PasswordValueObject;
    public function verify(string $plainPassword, string $hashedPassword): bool;
}
