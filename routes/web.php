<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\ForgotPasswordController;


// ─────────────────────────────────────────────
// Guest / Auth Routes (no login required)
// ─────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.password.send');

// Reset Password (link from email)
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('reset.password.form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password');

// Redirect root
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('authentication');

// ─────────────────────────────────────────────
// Protected Routes (must be logged in)
// ─────────────────────────────────────────────
Route::middleware(['authentication'])->group(function () {

    // ✅ First Login — Set Own Password
    Route::get('/set-password', [SetPasswordController::class, 'show'])->name('set.password');
    Route::post('/set-password', [SetPasswordController::class, 'update'])->name('set.password.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management (Admin Only)
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('role:admin');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('role:admin');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('role:admin');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('role:admin');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:admin');

});
