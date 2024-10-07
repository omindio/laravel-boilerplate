<?php

namespace App\Domain\User\Infrastucture\Services;

use App\Domain\User\Domain\Interfaces\PasswordServiceInterface;
use App\Domain\User\Domain\ValueObjects\PasswordValueObject;
use Illuminate\Support\Facades\Hash;

class PasswordService implements PasswordServiceInterface
{
    public function hash(string $plainPassword): PasswordValueObject
    {
        $hashedPassword = Hash::make($plainPassword);
        return new PasswordValueObject($hashedPassword, true);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }
}
