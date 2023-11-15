<?php

declare (strict_types=1);
namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{    
    /**
     * all
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }
    
    /**
     * findById
     *
     * @param  string $userId
     * @return User
     */
    public function findById(string $userId): User
    {
        return User::findOrFail($userId);
    }
    
    /**
     * update
     *
     * @param  User $user
     * @param  array $userData
     * @return void
     */
    public function update(User $user, array $userData): void
    {
        $user->update($userData);
        $user->save();
    }

}
