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
    public function attachUserDataToRequest(Request $request, int $userId): void
    {
        try {
            $user = User::findOrFail($userId);

            if ($user) {
                // Merge user data in to the request
                $request->merge(['user' => [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_coin_balance' => $user->coin_balance,
                    'last_login_at' => $user->last_login_at,
                    'last_coin_payout_at' => $user->last_coin_payout_at,
                    'transaction_history' => $user->coinTransactions->toArray()
                    ]
                ]);
            }
        } catch(\Exception $e) {
            Log::error("Error in attachUserDataToRequest: " . $e->getMessage());
        }
    }
}
