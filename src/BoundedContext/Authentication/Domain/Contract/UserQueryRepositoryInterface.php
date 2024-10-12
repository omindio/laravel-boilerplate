<?php

namespace App\BoundedContext\Authentication\Domain\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\UserId;

interface UserQueryRepositoryInterface
{
    public function findById(UserId $id): ?User;
    public function findByEmail(Email $email): ?User;
}
