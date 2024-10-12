<?php

namespace App\Infrastructure\Services;

use Illuminate\Support\Facades\Http;

class CaptchaService
{
    public function verify(string $captchaToken, string $remoteIp): bool
    {
        $secret = config('services.hcaptcha.secret');

        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => $secret,
            'response' => $captchaToken,
            'remoteip' => $remoteIp,
        ]);

        $responseData = $response->json();

        return $responseData['success'] ?? false;
    }
}
