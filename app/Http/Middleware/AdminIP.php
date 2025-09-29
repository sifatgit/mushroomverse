<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIPs = ['::1']; // Replace these with actual IPs 192.168.0.176

        // Check if user is authenticated and IP is allowed
        if (!in_array($request->ip(), $allowedIPs)) {
            // Redirect or deny access
            abort(404);
        }

        return $next($request);
    }
}
