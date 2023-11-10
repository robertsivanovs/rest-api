<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectNonAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        // Generate the token for the second app
        // $token = $user->createToken('api-token')->plainTextToken;

        // Redirect non-admin users to the second app
        if ($user && !$user->hasRole('admin')) {

            // Append the token as a query parameter to the redirect URL
            $redirectUrl = 'http://localhost:8001/?token=' . $token;

            return redirect()->away($redirectUrl);
        }

        return $next($request);
    }
}
