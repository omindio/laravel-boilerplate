<?php

namespace App\BoundedContext\Authentication\Application\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;

interface UserDatabaseMapperInterface
{
    public function toModel(User $user): object;
    public function toEntity(object $userModel): User;
}
