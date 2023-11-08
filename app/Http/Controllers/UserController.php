<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userData = $users = User::all();

        // If the user is an admin display the admin control panel
        if ($user->hasRole('admin')) {            
            return Inertia::render('User/Index', [
                'userData' => $userData
            ]);
        }

        // Redirect to the second app if the user is not an admin
        return redirect()->to('https://second-app-url');

    }
}
