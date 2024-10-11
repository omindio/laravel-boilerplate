<?php

namespace App\Shared\Infrastructure\Service;

use App\Shared\Domain\Contract\PasswordServiceInterface;
use Illuminate\Support\Facades\Hash;

class LaravelPasswordService implements PasswordServiceInterface
{
    public function hash(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }
}
