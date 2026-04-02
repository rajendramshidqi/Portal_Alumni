<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek status aktif
            if (auth()->user()->status !== 'active') {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'Akun Anda telah diblokir.',
                ]);
            }

            // Redirect sesuai role
            switch (auth()->user()->role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'moderator':
                    return redirect()->intended('/moderator/forums');

                case 'alumni':
                    return redirect()->intended('/');
                default:
                    Auth::logout();
                    abort(403, 'Role tidak dikenali');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
