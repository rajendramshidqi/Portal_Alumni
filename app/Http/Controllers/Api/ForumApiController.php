<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\KomentarForum;
use Illuminate\Http\Request;

class ForumApiController extends Controller
{
    // 🔥 GET: List forum (dengan search & filter)
    public function index(Request $request)
    {
        $query = Forum::with(['user', 'kategori', 'komentar'])
            ->where('status', 'approved');

        // 🔍 SEARCH
        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                    ->orWhere('isi', 'like', "%$search%")
                    ->orWhereHas('kategori', fn($k) =>
                        $k->where('nama', 'like', "%$search%")
                    )
                    ->orWhereHas('user', fn($u) =>
                        $u->where('name', 'like', "%$search%")
                    );
            });
        }

        // 📂 FILTER KATEGORI
        if ($request->filled('kategori')) {
            $query->where('kategori_forum_id', $request->kategori);
        }

        $forums = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $forums->items(), // 🔥 FIX: langsung array
            'meta'    => [
                'current_page' => $forums->currentPage(),
                'last_page'    => $forums->lastPage(),
                'total'        => $forums->total(),
            ],
        ]);
    }
    // 🔥 GET: Detail forum + komentar
    public function show($id)
    {

        $komentar = KomentarForum::with('user')
            ->where('forum_id', $id)
            ->withTrashed()
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success'  => true,

            'komentar' => $komentar,
        ]);
    }

    // 🔥 POST: Tambah forum
    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'kategori_forum_id' => 'required|exists:kategori_forums,id',
            'isi'               => 'required|string',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'users_id'          => auth()->id(),
            'kategori_forum_id' => $request->kategori_forum_id,
            'judul'             => $request->judul,
            'isi'               => $request->isi,
            'status'            => 'pending',
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('forum', 'public');
        }

        $forum = Forum::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Forum berhasil dikirim!',
            'data'    => $forum,
        ], 201);
    }

    // 🔥 GET: Trending forum
    public function trending()
    {
        $trending = Forum::withCount('komentar')
            ->where('status', 'approved')
            ->orderBy('komentar_count', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $trending,
        ]);
    }
    public function pending()
    {
        $forums = Forum::with(['user', 'kategori'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $forums,
        ]);
    }
}
