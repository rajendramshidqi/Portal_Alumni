<?php

namespace App\Http\Controllers;

use App\Models\KategoriLoker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriLokerController extends Controller
{
    public function index()
    {
        $kategori_lokers = KategoriLoker::all();
        return view('admin.kategori_loker.index', compact('kategori_lokers'));
    }

    public function create()
    {
        return view('admin.kategori_loker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriLoker::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('admin.kategori_loker.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriLoker $kategori_loker)
    {
        return view('admin.kategori_loker.edit', compact('kategori_loker'));
    }

    public function update(Request $request, KategoriLoker $kategori_loker)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori_loker->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        return redirect()->route('admin.kategori_loker.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriLoker $kategori_loker)
    {
        $kategori_loker->delete();
        return redirect()->route('admin.kategori_loker.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

