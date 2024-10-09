<?php

namespace App\BoundedContext\User\Infrastucture\Service;

use App\BoundedContext\User\Domain\Contract\UserPasswordServiceInterface;
use App\BoundedContext\User\Domain\ValueObject\Password;
use Illuminate\Support\Facades\Hash;

class LaravelHashPasswordService implements UserPasswordServiceInterface
{
    public function hash(string $plainPassword): Password
    {
        $hashedPassword = Hash::make($plainPassword);
        return new Password($hashedPassword, true);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }
}
