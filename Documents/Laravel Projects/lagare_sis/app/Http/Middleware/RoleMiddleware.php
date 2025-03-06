<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->role !== $role) {
            if ($request->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('student.dashboard');
        }

        return $next($request);
    }
} 