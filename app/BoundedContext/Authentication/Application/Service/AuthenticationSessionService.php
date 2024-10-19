<?php

namespace App\BoundedContext\Authentication\Application\Service;

use App\BoundedContext\Authentication\Application\Contract\AuthenticationSessionServiceInterface;
use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\Authentication\Domain\Entity\User;
use App\Shared\Domain\Contract\PasswordServiceInterface;
use App\Shared\Domain\Exception\IncorrectPasswordException;
use App\Shared\Domain\Exception\UserNotFoundException;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\Password;

class AuthenticationSessionService
{
    private $userQueryRepository;
    private $passwordService;
    private $sessionService;

    public function __construct(UserQueryRepositoryInterface $userQueryRepository, PasswordServiceInterface $passwordService, AuthenticationSessionServiceInterface $sessionService)
    {
        $this->userQueryRepository = $userQueryRepository;
        $this->passwordService = $passwordService;
        $this->sessionService = $sessionService;
    }

    public function login(Email $email, Password $password): User
    {
        $user = $this->userQueryRepository->findByEmail($email);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!$this->passwordService->verify($password->value(), $user->getPassword()->value())) {
            throw new IncorrectPasswordException('La contraseña no es correcta.');
        }

        $this->sessionService->createSession($user);

        return $user;
    }

    public function logout()
    {
        $this->sessionService->closeSession();
    }
}
