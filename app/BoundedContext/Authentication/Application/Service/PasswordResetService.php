<?php

namespace App\BoundedContext\Authentication\Application\Service;

use App\BoundedContext\Authentication\Domain\Contract\UserQueryRepositoryInterface;
use App\BoundedContext\Authentication\Application\Contract\AuthenticationNotificationServiceInterface;
use App\BoundedContext\Authentication\Domain\Contract\AuthenticationCommandRepositoryInterface;
use App\Shared\Domain\Contract\CaptchaInterface;
use App\Shared\Domain\ValueObject\Email;
use App\Shared\Domain\ValueObject\CaptchaToken;
use App\Shared\Domain\ValueObject\Ip;
use App\Shared\Domain\Exception\UserNotFoundException;
use App\Shared\Domain\Exception\InvalidCaptchaException;

use App\BoundedContext\Auth\Exceptions\InvalidTokenException;

class PasswordResetService
{
    private $captchaService;
    private $userQueryRepository;
    private $notificationService;
    private $authenticationCommandRepository;

    public function __construct(CaptchaInterface $captchaService, UserQueryRepositoryInterface $userQueryRepository, AuthenticationCommandRepositoryInterface $authenticationCommandRepository, AuthenticationNotificationServiceInterface $notificationService)
    {
        $this->captchaService = $captchaService;
        $this->userQueryRepository = $userQueryRepository;
        $this->authenticationCommandRepository = $authenticationCommandRepository;
        $this->notificationService = $notificationService;
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

        $token = $this->authenticationCommandRepository->createPasswordResetToken($user);

        $this->notificationService->sendPasswordResetNotification($user, $token);
    }

    public function resetPassword()
    {
        /*
        $credentials =
            $this->mapPasswordConfirmation($request->only('email', 'password', 'passwordConfirmation', 'token'));

        $status = Password::reset(
            $credentials,
            function ($user, $password) {
                $hashedPassword
                    = Hash::make($password);
                $this->userRepository->updatePassword($user, $hashedPassword);
            }
        );

        switch ($status) {
            case Password::PASSWORD_RESET:
                return true;
            case Password::INVALID_TOKEN:
                throw new InvalidTokenException();
            case Password::INVALID_USER:
                throw new UserNotFoundException('No se ha encontrado un usuario con ese correo electrónico.');
            default:
                throw new BaseException('Ha ocurrido un error inesperado.', 500);
        }
                */
    }
}
