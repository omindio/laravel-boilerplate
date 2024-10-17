<?php

namespace App\BoundedContext\User\Domain\Contract;

use App\BoundedContext\User\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserId;

interface UserQueryRepositoryInterface
{
    public function findById(UserId $id): ?User;
    public function findByEmail(Email $email): ?User;
}
