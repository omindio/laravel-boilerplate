<?php

namespace App\Domain\Auth\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomBasicAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $username = env('BASIC_AUTH_USERNAME', 'admin');
        $password = env('BASIC_AUTH_PASSWORD', 'secret');

        $hasValidCredentials = $request->getUser() === $username && $request->getPassword() === $password;

        if (!$hasValidCredentials) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
        }
        return $next($request);
    }
}
