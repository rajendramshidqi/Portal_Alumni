<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumniController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user           = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }
    public function index()
{
    $users = \App\Models\User::latest()->paginate(10);

    return view('admin.users.index', compact('users'));
}
}
