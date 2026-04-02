<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status === 'banned') {
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Akun Anda dibanned. Hubungi moderator.']);
        }

        return $next($request);
    }
}
