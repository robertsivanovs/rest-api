<?php

declare (strict_types=1);
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PersonalAccessToken;
use App\Traits\TokenValidatorTrait;
use App\Traits\UserDataAttacherTrait;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

/**
 * VerifyApiToken
 */
class VerifyApiToken
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        private PersonalAccessToken $personalAccessTokenModel, 
        private TokenValidatorTrait $tokenValidator,
        private UserDataAttacherTrait $userDataAttacher
    ) {}
    
    /**
     * handle
     *
     * Handle the token validation.
     * Pass user data to the second app if the token is valid
     * 
     * @param  Request $request
     * @param  Closure $next
     * @return Closure
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $token = $request->get('token');

        // Validate the token and redirect back to homepage if it fails
        if (!$token || !$this->tokenValidator->validateToken($token)) {
            Log::error('Token handling failed error');
            return Inertia::location(url()->current());
        }

        // Attach user data to request for later use in the Second app
        $apiToken = PersonalAccessToken::where('token', $token)->first();
        $userId = $apiToken->tokenable_id;

        $this->userDataAttacher->attachUserDataToRequest($request, $userId);

        return $next($request);
    }

}
