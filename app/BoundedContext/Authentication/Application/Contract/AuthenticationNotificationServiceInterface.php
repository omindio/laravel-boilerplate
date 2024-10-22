<?php

namespace App\BoundedContext\Authentication\Application\Contract;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;

interface AuthenticationNotificationServiceInterface
{
    public function sendPasswordResetNotification(User $user, PasswordResetToken $token): void;
}
