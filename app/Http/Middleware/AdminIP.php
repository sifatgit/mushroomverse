<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminIP
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIPs = ['127.0.0.1','::1']; // Add your LAN IPs if needed

        // 1️⃣ Check if user is logged in



        // 2️⃣ Check if IP is allowed
        if (!in_array($request->ip(), $allowedIPs)) {
            abort(404);
        }

        if (Auth::check()) {
            return redirect('/admin-dashboard');
        }        

        return $next($request);
    }
}
