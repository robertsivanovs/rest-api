<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Define the homepage route without middleware
Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

// Apply the 'auth' middleware group for authentication and verification
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Define the dashboard route and apply the redirectNonAdmin middleware
    Route::get('/dashboard', [UserController::class, 'index'])
        ->middleware('redirectNonAdmin')
        ->name('dashboard');

    // Define a route to access the user data editing view
    Route::get('/edit/{userId}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{userId}', [UserController::class, 'update'])->name('user.update');
});

