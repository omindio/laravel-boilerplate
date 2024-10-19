<?php

namespace App\BoundedContext\Authentication\Infrastructure\Service;

use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;
use App\BoundedContext\Authentication\Application\Contract\AuthenticationSessionServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LaravelAuthenticationSessionService implements AuthenticationSessionServiceInterface
{
    public function createSession(User $user): void
    {
        Auth::guard('web')->loginUsingId($user->getId()->value());
        Session::regenerate();
        //dd(session()->getId());
    }

    public function closeSession(): void
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
