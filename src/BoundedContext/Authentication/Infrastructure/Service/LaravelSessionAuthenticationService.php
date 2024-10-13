<?php

namespace App\BoundedContext\Authentication\Infrastructure\Service;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\BoundedContext\Authentication\Application\Contract\SessionAuthenticationInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LaravelSessionAuthenticationService implements SessionAuthenticationInterface
{
    public function createSession(User $user): void
    {
        $userModel = new UserModel();

        $userModel->id = $user->getId()->value();
        $userModel->email = $user->getEmail()->value();
        $userModel->password = $user->getPassword()->value();

        Auth::guard('web')->login($userModel);

        Session::regenerate();
    }

    public function closeSession(): void
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
    }
}
