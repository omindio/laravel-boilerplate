<?php

namespace App\BoundedContext\Authentication\Application\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;

interface SessionAuthenticationInterface
{
    public function createSession(User $user): void;
    public function closeSession(): void;
}
