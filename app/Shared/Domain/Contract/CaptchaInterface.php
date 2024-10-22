<?php

namespace App\Shared\Domain\Contract;

use App\Shared\Domain\ValueObject\CaptchaToken;
use App\Shared\Domain\ValueObject\Ip;

interface CaptchaInterface
{
    public function verify(CaptchaToken $captchaToken, Ip $remoteIp): bool;
}
