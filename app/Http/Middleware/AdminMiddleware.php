<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && ($request->user()->role === 'admin' || $request->user()->role === 'government')) {
            return $next($request);
        }

        throw new AuthorizationException('Unauthorized. Admin access required.');
    }
}
