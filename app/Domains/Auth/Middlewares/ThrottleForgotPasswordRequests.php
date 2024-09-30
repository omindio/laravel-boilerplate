<?php

namespace App\Domains\Auth\Middlewares;

use Closure;
use App\Shared\Http\Responses\ApiErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleForgotPasswordRequests extends ThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $maxAttempts = 4, $decayMinutes = 60, $prefix = ''): Response
    {
        $key = $this->resolveRequestSignature($request);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return ApiErrorResponse::send('Demasiados intentos de restablecimiento de contraseña. Por favor, inténtelo de nuevo en ' . $decayMinutes . ' minutos.', [], 429);
        }
        RateLimiter::hit($key, $decayMinutes * 60);

        return $next($request);
    }

    protected function resolveRequestSignature($request)
    {
        return sha1($request->ip() . '|' . $request->input('email'));
    }
}
