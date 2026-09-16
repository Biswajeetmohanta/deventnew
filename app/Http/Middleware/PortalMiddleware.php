<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PortalMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->guest(url('/portal/login'));
        }

        if (!Auth::user()->isClient()) {
            Auth::logout();
            return redirect(url('/portal/login'))->withErrors([
                'email' => 'Unauthorized access. This area is reserved for clients.',
            ]);
        }

        return $next($request);
    }
}
