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
    public function boot(CoinService $coinService): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) use ($coinService) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $this->handleUserLogin($user, $coinService);
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
    private function handleUserLogin(User $user, CoinService $coinService): User
    {
        try {
            $now = Carbon::now();

            // If user has never logged in then add coins
            if (!$user->last_login_at) {
                $coinService->addCoins($user, config('coinrewards.amount'));
            }

            // Check if 24 hours have passed since the last login
            if ($user->last_login_at) {
                $lastLogin = Carbon::parse($user->last_login_at);

                if ($lastLogin->diffInHours($now) >= 24) {
                    $coinService->addCoins($user, config('coinrewards.amount'));
                }    
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
