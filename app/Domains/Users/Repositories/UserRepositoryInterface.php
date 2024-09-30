<?php

namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function createPasswordResetToken(User $user): string;
    public function updatePassword(User $user, string $hashedPassword): bool;
}
