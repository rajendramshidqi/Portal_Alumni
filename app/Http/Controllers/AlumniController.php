<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    // ===============================
    // UPDATE PASSWORD
    // ===============================
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

    // ===============================
    // UPDATE FOTO PROFIL
    // ===============================
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('foto')) {

         
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            $path = $request->file('foto')->store('foto_profil', 'public');

           
            $user->update([
                'foto' => $path,
            ]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }

    // ===============================
    // LIST USER (ADMIN)
    // ===============================
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }
}
