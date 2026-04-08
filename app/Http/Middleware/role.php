<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, $role)
    {
        if (! Auth::check()) {
            abort(403, 'Access denied. Please login first.');
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Access denied. You must be a ' . $role . '.');
        }
      

        return $next($request);
    }
}
    