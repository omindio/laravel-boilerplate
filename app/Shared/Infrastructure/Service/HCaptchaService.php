<?php

namespace App\Shared\Infrastructure\Service;

use App\Shared\Domain\Contract\CaptchaInterface;
use App\Shared\Domain\ValueObject\CaptchaToken;
use App\Shared\Domain\ValueObject\Ip;
use Illuminate\Support\Facades\Http;

class HCaptchaService implements CaptchaInterface
{
    public function verify(CaptchaToken $captchaToken, Ip $remoteIp): bool
    {
        $secret = config('services.hcaptcha.secret');

        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => $secret,
            'response' => $captchaToken->value(),
            'remoteip' => $remoteIp->value(),
        ]);

        $responseData = $response->json();

        return $responseData['success'] ?? false;
    }
}
