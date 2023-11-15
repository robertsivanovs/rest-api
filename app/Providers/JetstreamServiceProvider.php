<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Services\CoinService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $this->handleUserLogin($user);
            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }

    /**
     * Handle user login actions.
     *
     * @param User       $user
     * @param CoinService $coinService
     *
     * @return User
     */
    private function handleUserLogin(User $user): User
    {
        try {
            $now = Carbon::now();

            // Get the last coin transaction date
            $lastPayoutDate = $user->coinTransactions()->latest()->value('created_at');

            // If user has never logged in then add coins
            if (!$user->last_login_at || !$lastPayoutDate) {
                CoinService::addCoins($user, config('coinrewards.amount'));
            }

            // Check if 24 hours have passed since the last payout
            if ($lastPayoutDate && Carbon::parse($lastPayoutDate)->diffInHours($now) >= 24) {
                CoinService::addCoins($user, config('coinrewards.amount'));
            }

            // Update last login date
            $user->last_login_at = $now;
            $user->save();

            // Log the event
            Log::info('User logged in', ['user_id' => $user->id]);

            return $user;
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
        }
    }
}
