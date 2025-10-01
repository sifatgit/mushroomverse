<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        $allowedIPs = ['127.0.0.1','::1']; // Replace these with actual admin IPs 192.168.0.176

        // Check if user is authenticated and IP is allowed
        if (!in_array($request->ip(), $allowedIPs)) {
            // Redirect or deny access
            abort(404);
        }
        return $request->expectsJson() ? null : route('login');
    }
}
