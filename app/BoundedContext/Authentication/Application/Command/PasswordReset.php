<?php

namespace App\BoundedContext\Authentication\Application\Command;

class PasswordReset
{
    private string $email;
    private string $token;
    private string $newPassword;
    private string $confirmPassword;

    public function __construct(string $email, string $newPassword, string $confirmPassword, string $token)
    {
        $this->email = $email;
        $this->token = $token;
        $this->newPassword = $newPassword;
        $this->confirmPassword = $confirmPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
}
