<?php

declare (strict_types=1);
namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * UserDataAttacherTrait
 */
class UserDataAttacherTrait
{    
    /**
     * attachUserDataToRequest
     * 
     * Attach user data from the database to the API request
     *
     * @param  Request $request
     * @param  string $userId
     * @return void
     */
    public function attachUserDataToRequest(Request $request, $userId): void
    {
        try {
            $user = (array)User::findOrFail($userId);

            if ($user) {
                $request->merge(['user' => $user]);
            }
        } catch(\Exception $e) {
            Log::error("Error in attachUserDataToRequest: " . $e->getMessage());
        }
    }
}
