<?php

namespace App\BoundedContext\Authentication\Application\Command;

class RequestPasswordReset
{
    private string $email;
    private string $captchaToken;
    private string $ip;

    public function __construct(string $email, string $captchaToken, string $ip)
    {
        $this->email = $email;
        $this->captchaToken = $captchaToken;
        $this->ip = $ip;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCaptchaToken(): string
    {
        return $this->captchaToken;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
