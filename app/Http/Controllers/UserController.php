<?php

declare (strict_types=1);
namespace App\Http\Controllers;

use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\UpdateUserRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{    
    /**
     * __construct
     * 
     * PHP 8+ constructor promotion
     *
     * @return void
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}
    
    /**
     * index
     * 
     * Return user list for admin dashboard
     *
     * @return Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $userData = $this->userRepository->all();

        return Inertia::render('User/Index', [
            'userData' => $userData
        ]);
    }
    
    /**
     * edit
     * 
     * Return user data for user edit view in admin dashboard
     *
     * @param  string $userId
     * @return Inertia\Response
     */
    public function edit(string $userId): \Inertia\Response
    {
        try {
            $userData = $this->userRepository->findById($userId);

            return Inertia::render('User/Edit', [
                'userData' => $userData
            ]);
        } catch (\Exception $e) {
            // Redirect the user back to the dashboard and log the error message
            Log::error("Error editing user with ID {$userId}: {$e->getMessage()}");
            return Inertia::render('Auth/Login');
        }
    }
    
    /**
     * update
     * 
     * Update user data by admin
     *
     * @param  string $userId
     * @param  UpdateUserRequest $updateUserRequest
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(string $userId, UpdateUserRequest $updateUserRequest): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = $this->userRepository->findById($userId);
            $this->userRepository->update($user, $updateUserRequest->validated());

            return redirect()->route('dashboard')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error($e->getMessage());

            // Return an error message to the user
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
    }

}
