<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Check if the user is logged in
        if (!$user) {
            return redirect()->route('auth.login');
        }

        // Check if the user has the required role
        if ($user->role !== $role) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
