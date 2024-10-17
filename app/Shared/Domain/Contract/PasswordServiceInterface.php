<?php

namespace App\Shared\Domain\Contract;

interface PasswordServiceInterface
{
    public function hash(string $plainPassword): string;
    public function verify(string $plainPassword, string $hashedPassword): bool;
}
