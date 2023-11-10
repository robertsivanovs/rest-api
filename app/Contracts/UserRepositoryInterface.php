<?php

namespace App\Contracts;
use App\Models\User;

interface UserRepositoryInterface
{    
    /**
     * all
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection;    
    /**
     * findById
     *
     * @param  string $userId
     * @return User
     */
    public function findById(string $userId): User;    
    /**
     * update
     *
     * @param  User $user
     * @param  array $userData
     * @return void
     */
    public function update(User $user, array $userData): void;
}
