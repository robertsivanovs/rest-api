<?php

declare (strict_types=1);
namespace App\Traits;

use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Log;

/**
 * TokenValidatorTrait
 */
class TokenValidatorTrait
{    
    /**
     * validateToken
     *
     * @param  mixed $token
     * @return void
     */
    public function validateToken($token)
    {
        try {
            $apiToken = PersonalAccessToken::where('token', $token)->first();

            return $apiToken !== null;
        } catch (\Exception $e) {
            Log::error('Token validation error: ' . $e->getMessage());
            return false;
        }
    }
}
