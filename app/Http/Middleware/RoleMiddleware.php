<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Check if the user's role is in the allowed roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }
        // If user doesn't have the required role, redirect to dashboard with alert
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
    }
}
