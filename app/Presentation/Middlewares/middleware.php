<?php

use App\Domain\Auth\Http\Middlewares\ThrottleForgotPasswordRequests;

$middleware->throttleWithRedis();
$middleware->statefulApi();
//$middleware->alias(['custom.auth.basic' => CustomBasicAuthMiddleware::class]);
$middleware->alias(['throttle.forgot.password' => ThrottleForgotPasswordRequests::class]);
