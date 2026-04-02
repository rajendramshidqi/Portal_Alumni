<?php
namespace App\Http\Controllers;

use App\Models\KategoriForum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriForumController extends Controller
{
    public function index()
    {
        $kategori_forums = KategoriForum::all();
        return view('admin.kategori_forum.index', compact('kategori_forums'));
    }

    public function create()
    {
        return view('admin.kategori_forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriForum::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('admin.kategori_forum.index')->with('success', 'Kategori forum berhasil ditambahkan.');
    }

    public function edit(KategoriForum $kategori_forum)
    {
        return view('admin.kategori_forum.edit', compact('kategori_forum'));
    }

    public function update(Request $request, KategoriForum $kategori_forum)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori_forum->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('admin.kategori_forum.index')->with('success', 'Kategori forum berhasil diperbarui.');
    }

    public function destroy(KategoriForum $kategori_forum)
    {
        $kategori_forum->delete();
        return redirect()->route('admin.kategori_forum.index')->with('success', 'Kategori forum berhasil dihapus.');
    }
}
