<?php

namespace App\BoundedContext\User\Application\Contract;

use App\BoundedContext\User\Domain\Entity\User;

interface UserDatabaseMapperInterface
{
    public function toEntity(object $userModel): User;
}
