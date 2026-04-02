<?php
namespace App\Http\Controllers;

use App\Models\KomentarForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarForumController extends Controller
{
   public function store(Request $request, $forum_id)
{
    $request->validate([
        'isi' => 'required|string|max:1000',
    ]);

    // Daftar kata kasar
    $kataKasar = ['bodoh', 'goblok', 'anjing', 'babi', 'kontolll', 'bangsat','ewe','tolol'];
    $isiKomentar = strtolower($request->isi);
    $mengandungKasar = false;

    foreach ($kataKasar as $kata) {
        if (str_contains($isiKomentar, $kata)) {
            $mengandungKasar = true;
            break;
        }
    }

    KomentarForum::create([
        'forum_id' => $forum_id,
        'users_id' => Auth::id(),
        'isi'      => $request->isi,
        'is_kasar' => $mengandungKasar, // <== ini tambahan penting
    ]);

    return back()->with('success', 'Komentar berhasil dikirim.');
}


    // Tampilkan form edit komentar
    public function edit(KomentarForum $komentar)
    {
        // Hanya user yang membuat komentar yang bisa edit
        if (Auth::id() !== $komentar->users_id) {
            abort(403);
        }

        return view('alumni.forums.edit', compact('komentar'));

    }

    // Update komentar
    public function update(Request $request, KomentarForum $komentar)
    {
        if (Auth::id() !== $komentar->users_id) {
            abort(403);
        }

        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $komentar->update([
            'isi' => $request->isi,
        ]);

        return redirect()->route('forum.show', $komentar->forum_id)
            ->with('success', 'Komentar berhasil diperbarui.');
    }

    // Hapus komentar (alumni atau moderator)
public function destroy($id)
{
    $komentar = KomentarForum::withTrashed()->findOrFail($id);

    // 🔹 ALUMNI
    if (Auth::user()->hasRole('alumni')) {

        // alumni hanya boleh hapus komentar sendiri
        if (Auth::id() !== $komentar->users_id) {
            abort(403);
        }

        // HARD DELETE (langsung hilang dari DB)
        $komentar->forceDelete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

    // 🔹 MODERATOR
    if (Auth::user()->hasRole('moderator')) {

        // SOFT DELETE
        if (!$komentar->trashed()) {
            $komentar->delete();
        }

        return back()->with('success', 'Komentar dihapus oleh moderator.');
    }

    abort(403);
}

    public function read($id)
{
    $komentar = KomentarForum::with('forum')->findOrFail($id);

    // Hanya pemilik forum yang bisa baca notifikasi
    if ($komentar->forum->users_id == auth()->id()) {
        $komentar->is_read = true;
        $komentar->save();
    }

    return redirect()->route('forum.show', $komentar->forum_id) . '#komentar-' . $komentar->id;
}

}
