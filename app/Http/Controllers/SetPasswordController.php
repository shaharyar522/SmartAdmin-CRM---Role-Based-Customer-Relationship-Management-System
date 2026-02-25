<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetPasswordController extends Controller
{
    /**
     * Show the "Set Your Own Password" page (only for first-time login users).
     */
    public function show()
    {
        $user = Auth::user();

        // Admin never needs to set password — always go to dashboard
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        // If staff/manager already set their password, go to dashboard
        if (!$user->is_first_login) {
            return redirect()->route('dashboard');
        }

        return view('auth.set-password');
    }

    /**
     * Save the new permanent password and mark first login as done.
     */
    public function update(Request $request)
    {
        $request->validate([
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        $user->update([
            'password'       => Hash::make($request->password),
            'is_first_login' => false,   // ✅ Permanently mark done
        ]);

        return redirect()->route('dashboard')->with('success', 'Password set successfully! Welcome to SmartAdmin CRM.');
    }
}
