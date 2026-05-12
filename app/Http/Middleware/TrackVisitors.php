<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track on GET requests and not for admin routes
        if ($request->isMethod('GET') && !$request->is('admin*')) {
            $ip = $request->ip();
            $userAgent = $request->userAgent();

            $trackedInSession = $request->hasSession() && $request->session()->has('visitor_tracked');

            if (!$trackedInSession) {
                // Check database for unique IP + User Agent
                $exists = \App\Models\Visitor::where('ip_address', $ip)
                    ->where('user_agent', $userAgent)
                    ->exists();

                if (!$exists) {
                    \App\Models\Visitor::create([
                        'ip_address' => $ip,
                        'user_agent' => $userAgent,
                    ]);
                }

                // Mark as tracked in session if available
                if ($request->hasSession()) {
                    $request->session()->put('visitor_tracked', true);
                }
            }
        }

        return $next($request);
    }
}
