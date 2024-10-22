<?php

namespace App\BoundedContext\Authentication\Infrastructure\Persistence\Eloquent;

use App\BoundedContext\Authentication\Application\Contract\UserDatabaseMapperInterface;
use App\BoundedContext\Authentication\Domain\Contract\AuthenticationCommandRepositoryInterface;
use App\BoundedContext\Authentication\Domain\Entity\User;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;
use Illuminate\Support\Facades\Password;

class EloquentAuthenticationCommandRepository implements AuthenticationCommandRepositoryInterface
{
    private UserDatabaseMapperInterface $userDatabaseMapper;

    public function __construct(UserDatabaseMapperInterface $userDatabaseMapper)
    {
        $this->userDatabaseMapper = $userDatabaseMapper;
    }

    public function createPasswordResetToken(User $user): PasswordResetToken
    {
        $userModel = $this->userDatabaseMapper->toModel($user);
        $token = Password::createToken($userModel);

        return new PasswordResetToken($token);
    }
}
