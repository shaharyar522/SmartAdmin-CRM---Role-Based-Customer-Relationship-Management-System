<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * Show the Forgot Password form.
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send the password reset link to the user's email.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No account found with this email address.',
        ]);

        // Generate a secure token
        $token = Str::random(64);

        // Store it in password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token'      => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        // Build reset URL
        $resetUrl = url('/reset-password?token=' . $token . '&email=' . urlencode($request->email));

        // Send email
        $user = User::where('email', $request->email)->first();

        try {
            Mail::send('emails.reset-password', [
                'user'     => $user,
                'resetUrl' => $resetUrl,
            ], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('SmartAdmin CRM - Password Reset Request');
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Could not send reset email. Please try again later.');
        }

        return back()->with('success', 'Password reset link has been sent to your email address!');
    }

    /**
     * Show the Reset Password form.
     */
    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');

        if (!$token || !$email) {
            return redirect()->route('forgot.password')->with('error', 'Invalid reset link.');
        }

        return view('auth.reset-password', compact('token', 'email'));
    }

    /**
     * Process the new password and save it permanently.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:users,email',
            'token'                 => 'required',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Find the token record
        $tokenRecord = DB::table('password_reset_tokens')
                         ->where('email', $request->email)
                         ->first();

        if (!$tokenRecord) {
            return back()->with('error', 'Invalid reset link. Please request a new one.');
        }

        // Check token is valid (not expired — 60 minutes window)
        if (Carbon::parse($tokenRecord->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->with('error', 'Reset link has expired. Please request a new one.');
        }

        // Verify token hash
        if (!Hash::check($request->token, $tokenRecord->token)) {
            return back()->with('error', 'Invalid reset token. Please request a new one.');
        }

        // Update password — mark is_first_login false (they've now set their own password)
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password'       => Hash::make($request->password),
            'is_first_login' => false,
        ]);

        // Delete the used token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully! You can now log in.');
    }
}
