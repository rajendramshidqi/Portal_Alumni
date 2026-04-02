<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\KomentarForum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // Menampilkan forum yang menunggu persetujuan (untuk moderator)
    public function index()
    {
        $forums = Forum::with(['kategori', 'user', 'komentarKasar.user'])
            ->where('status', 'pending')
            ->latest()
            ->get();
        $komentarKasarSemua = \App\Models\KomentarForum::with('forum', 'user')
            ->where('is_kasar', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('moderator.forums.index', compact('forums', 'komentarKasarSemua'));
    }

   
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

        // 🔥 HANDLE UPLOAD FOTO
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('forum', 'public');
        }

        Forum::create($data);

        return redirect()->route('alumni.forums.dashboard')
            ->with('success', 'Forum berhasil dikirim!');
    }

  
    public function show($id)
    {
        $forum = Forum::with(['kategori', 'user'])->findOrFail($id);

      
        $komentar = KomentarForum::with('user')
            ->where('forum_id', $forum->id)
            ->withTrashed() 
            ->orderBy('created_at', 'asc')
            ->get();

        
        if (auth()->id() === $forum->users_id) {
            KomentarForum::where('forum_id', $forum->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return view('alumni.forums.show', compact('forum', 'komentar'));
    }
   public function berita(Request $request)
{
    $query = Forum::with(['user', 'kategori', 'komentar'])
        ->where('status', 'approved');

    
    if ($request->filled('q')) {
        $search = $request->q;

        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('isi', 'like', '%' . $search . '%')
              ->orWhereHas('kategori', function ($k) use ($search) {
                  $k->where('nama', 'like', '%' . $search . '%');
              })
              ->orWhereHas('user', function ($u) use ($search) {
                  $u->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    // 📂 FILTER KATEGORI
    if ($request->filled('kategori')) {
        $query->where('kategori_forum_id', $request->kategori);
    }

    $forums = $query->latest()->paginate(10)->withQueryString();

    // 🔥 TRENDING (tidak ikut ke-filter search biar tetap global)
    $trending = Forum::withCount('komentar')
        ->where('status', 'approved')
        ->orderBy('komentar_count', 'desc')
        ->take(5)
        ->get();

    return view('alumni.forums.index', compact('forums', 'trending'));
}
}
