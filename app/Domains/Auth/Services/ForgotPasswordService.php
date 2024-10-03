<?php

namespace App\Domains\Auth\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Domains\Auth\Notifications\ResetPasswordNotification;
use App\Domains\Auth\Exceptions\InvalidCaptchaException;
use App\Domains\Users\Exceptions\UserNotFoundException;
use App\Domains\Users\Repositories\UserRepositoryInterface;
use App\Shared\Services\CaptchaService;
use Illuminate\Support\Facades\Hash;
use App\Domains\Auth\Exceptions\InvalidTokenException;
use App\Shared\Exceptions\BaseException;
use App\Shared\Traits\MapsPasswordConfirmation;

class ForgotPasswordService
{
    use MapsPasswordConfirmation;

    protected $captchaService;
    protected $userRepository;

    public function __construct(CaptchaService $captchaService, UserRepositoryInterface $userRepository)
    {
        $this->captchaService = $captchaService;
        $this->userRepository = $userRepository;
    }

    public function forgotPassword(Request $request)
    {
        $isCaptchaValid = $this->captchaService->verify($request->captchaToken, $request->ip());

        if (!$isCaptchaValid) {
            throw new InvalidCaptchaException();
        }

        $user = $this->userRepository->findByEmail($request->email);

        if (!$user) {
            throw new UserNotFoundException('No se ha encontrado un usuario con ese correo electrónico.');
        }

        $token = $this->userRepository->createPasswordResetToken($user);
        $user->notify(new ResetPasswordNotification($token, $request->email));
    }

    public function resetPassword(Request $request)
    {
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
    }
}
