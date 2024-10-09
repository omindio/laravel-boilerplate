<?php

namespace App\BoundedContext\User\Domain\Contract;

use App\BoundedContext\User\Domain\Entity\User;

interface UserCommandRepositoryInterface
{
    public function updatePassword(User $user): bool;
    public function updateProfile(User $user): bool;
}
