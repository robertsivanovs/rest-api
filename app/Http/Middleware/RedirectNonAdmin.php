<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

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

        // Redirect non-admin users to the second app
        if ($user && !$user->hasRole('admin')) {

            try {
                // Generate the token for the second app
                $token = $user->createToken('api-token');
            
                // Append the token as a query parameter to the redirect URL
                $redirectUrl = config('secondapp.url') . '?token=' . $token->accessToken->token;
                
                return Inertia::location($redirectUrl);

            } catch(\Exception $e) {
                Log::error('Token generation error: ' . $e->getMessage());
            }

        }

        return $next($request);
    }
}
