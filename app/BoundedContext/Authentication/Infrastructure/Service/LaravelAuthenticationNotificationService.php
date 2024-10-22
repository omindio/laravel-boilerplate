<?php

namespace App\BoundedContext\Authentication\Infrastructure\Service;

use App\BoundedContext\Authentication\Application\Contract\AuthenticationNotificationServiceInterface;
use App\BoundedContext\Authentication\Application\Contract\UserDatabaseMapperInterface;
use App\BoundedContext\Authentication\Domain\Entity\User;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;
use App\BoundedContext\Authentication\Infrastructure\Notification\RequestPasswordResetNotification;

class LaravelAuthenticationNotificationService implements AuthenticationNotificationServiceInterface
{
    private UserDatabaseMapperInterface $userDatabaseMapper;

    public function __construct(UserDatabaseMapperInterface $userDatabaseMapper)
    {
        $this->userDatabaseMapper = $userDatabaseMapper;
    }
    public function sendPasswordResetNotification(User $user, PasswordResetToken $token): void
    {
        $userModel = $this->userDatabaseMapper->toModel($user);
        $userModel->notify(new RequestPasswordResetNotification($token->value(), $user->getEmail()->value()));
    }
    /*
    private function mapUserToModel(User $user): UserModel
    {
        // Mapea la entidad User al modelo de Laravel UserModel
        $userModel = new UserModel();
        $userModel->id = $user->getId()->value();
        $userModel->email = $user->getEmail()->value();
        // Mapear otros campos necesarios

        return $userModel;
    }
        */
}
