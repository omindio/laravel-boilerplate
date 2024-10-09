<?php

namespace App\BoundedContext\User\Domain\Contract;

use App\BoundedContext\User\Domain\ValueObject\Password;

interface UserPasswordServiceInterface
{
    public function hash(string $plainPassword): Password;
    public function verify(string $plainPassword, string $hashedPassword): bool;
}
