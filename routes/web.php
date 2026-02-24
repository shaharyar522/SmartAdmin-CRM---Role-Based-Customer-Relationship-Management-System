<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\http\Middleware\Authenticate;


// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root to login or dashboard
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('authentication');

// Protected Routes
Route::middleware(['authentication'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // User Management (Admin Only)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

});
