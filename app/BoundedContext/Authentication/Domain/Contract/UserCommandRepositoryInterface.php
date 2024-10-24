<?php

namespace App\BoundedContext\Authentication\Domain\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;

interface UserCommandRepositoryInterface
{
    public function updatePassword(User $user): bool;
}
