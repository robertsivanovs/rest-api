<?php

declare (strict_types=1);
namespace App\Services;

use App\Models\User;
use App\Models\UserTransaction;

/**
 * CoinService
 */
class CoinService
{    
    /**
     * addCoins
     *
     * @param  User $user
     * @param  int $amount
     * @return void
     */
    public function addCoins(User $user, int $amount): void
    {
        // Add logic to add coins to the user's balance
        $user->coin_balance += $amount;
        $user->save();

        // Record the transaction
        UserTransaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
        ]);
    }
}
