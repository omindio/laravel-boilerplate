<?php

namespace App\BoundedContext\Authentication\Application\Service;

use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\Authentication\Application\Contract\AuthenticationNotificationServiceInterface;
use App\BoundedContext\Authentication\Domain\Contract\AuthenticationCommandRepositoryInterface;
use App\BoundedContext\Authentication\Domain\Contract\AuthenticationQueryRepositoryInterface;
use App\Shared\Domain\Contract\CaptchaInterface;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\CaptchaToken;
use App\Shared\Domain\ValueObject\Ip;
use App\Shared\Domain\ValueObject\Password;
use App\Shared\Domain\Exception\UserNotFoundException;
use App\Shared\Domain\Exception\InvalidCaptchaException;
use App\BoundedContext\Authentication\Domain\ValueObject\PasswordResetToken;
use App\BoundedContext\Authentication\Domain\ValueObject\UpdatePassword;
use App\Shared\Domain\Contract\PasswordServiceInterface;
use App\BoundedContext\Authentication\Domain\Exception\InvalidTokenException;
use App\BoundedContext\Authentication\Application\Contract\AuthenticationPasswordTokenValidationServiceInterface;
use App\BoundedContext\Authentication\Domain\Contract\UserCommandRepositoryInterface;

class PasswordResetService
{
    private $passwordService;
    private $captchaService;
    private $userQueryRepository;
    private $notificationService;
    private $authenticationCommandRepository;
    private $tokenValidationService;
    private $authenticationQueryRepository;
    private $userCommandRepository;

    public function __construct(
        PasswordServiceInterface $passwordService,
        CaptchaInterface $captchaService,
        UserCommandRepositoryInterface $userCommandRepository,
        UserQueryRepositoryInterface $userQueryRepository,
        AuthenticationCommandRepositoryInterface $authenticationCommandRepository,
        AuthenticationNotificationServiceInterface $notificationService,
        AuthenticationPasswordTokenValidationServiceInterface $tokenValidationService,
        AuthenticationQueryRepositoryInterface $authenticationQueryRepository
    ) {
        $this->passwordService = $passwordService;
        $this->captchaService = $captchaService;
        $this->userQueryRepository = $userQueryRepository;
        $this->authenticationCommandRepository = $authenticationCommandRepository;
        $this->notificationService = $notificationService;
        $this->tokenValidationService = $tokenValidationService;
        $this->authenticationQueryRepository = $authenticationQueryRepository;
        $this->userCommandRepository = $userCommandRepository;
    }

    public function requestPasswordReset(Email $email, CaptchaToken $captchaToken, Ip $ip)
    {
        $isCaptchaValid = $this->captchaService->verify($captchaToken, $ip);

        if (!$isCaptchaValid) {
            throw new InvalidCaptchaException();
        }

        $user = $this->userQueryRepository->findByEmail($email);

        if (!$user) {
            throw new UserNotFoundException('No se ha encontrado un usuario con ese correo electrónico.');
        }

        $token = $this->authenticationCommandRepository->createPasswordToken($user);

        $this->notificationService->sendPasswordResetNotification($user, $token);
    }

    public function passwordReset(Email $email, UpdatePassword $updatePassword, PasswordResetToken $token)
    {
        $tokenResponse = $this->authenticationQueryRepository->findPasswordToken($email, $token);

        if (!$tokenResponse || !$this->tokenValidationService->isValidToken($token, $tokenResponse)) {
            throw new InvalidTokenException('Has introducido un token inválido o ya ha sido utilizado.');
        }

        if ($this->tokenValidationService->isTokenExpired($tokenResponse)) {
            throw new InvalidTokenException('El token ha expirado.');
        }

        $user = $this->userQueryRepository->findByEmail($email);

        if (!$user) {
            throw new UserNotFoundException('No se ha encontrado un usuario con ese correo electrónico.');
        }

        $hashedPasswordValueObject = $this->passwordService->hash($updatePassword->getNewPassword()->value());

        $user->setPassword(new Password($hashedPasswordValueObject));

        $this->userCommandRepository->updatePassword($user);
        $this->authenticationCommandRepository->deletePasswordToken($email, $tokenResponse);
    }
}
