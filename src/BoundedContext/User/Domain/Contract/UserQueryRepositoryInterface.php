<?php

namespace App\BoundedContext\User\Domain\Contract;

use App\BoundedContext\User\Domain\Entity\User;
use App\BoundedContext\User\Domain\ValueObject\Email;
use App\BoundedContext\User\Domain\ValueObject\Id;

interface UserQueryRepositoryInterface
{
    public function findById(Id $id): ?User;
    public function findByEmail(Email $email): ?User;
}
