<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KomentarForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarApiForumController extends Controller
{
    // 🔥 GET: ambil komentar berdasarkan forum
    public function index($forum_id)
    {
        $komentar = KomentarForum::with('user')
            ->where('forum_id', $forum_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $komentar,
        ]);
    }

    // 🔥 POST: tambah komentar
    public function store(Request $request, $forum_id)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $kataKasar       = ['bodoh', 'goblok', 'anjing', 'babi', 'kontolll', 'bangsat', 'ewe', 'tolol'];
        $isiKomentar     = strtolower($request->isi);
        $mengandungKasar = false;

        foreach ($kataKasar as $kata) {
            if (str_contains($isiKomentar, $kata)) {
                $mengandungKasar = true;
                break;
            }
        }

        $komentar = KomentarForum::create([
            'forum_id' => $forum_id,
            'users_id' => Auth::id(),
            'isi'      => $request->isi,
            'is_kasar' => $mengandungKasar,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dikirim',
            'data'    => $komentar,
        ], 201);
    }

    // 🔥 UPDATE komentar
    public function update(Request $request, $id)
    {
        $komentar = KomentarForum::findOrFail($id);

        if (Auth::id() !== $komentar->users_id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }

        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $komentar->update([
            'isi' => $request->isi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil diperbarui',
            'data'    => $komentar,
        ]);
    }

    // 🔥 DELETE komentar
    public function destroy($id)
    {
        $komentar = KomentarForum::withTrashed()->findOrFail($id);

        // ALUMNI
        if (Auth::user()->hasRole('alumni')) {
            if (Auth::id() !== $komentar->users_id) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $komentar->forceDelete();

            return response()->json([
                'success' => true,
                'message' => 'Komentar berhasil dihapus',
            ]);
        }

        // MODERATOR
        if (Auth::user()->hasRole('moderator')) {
            if (! $komentar->trashed()) {
                $komentar->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Komentar dihapus oleh moderator',
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
