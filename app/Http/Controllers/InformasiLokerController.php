<?php
namespace App\Http\Controllers;

use App\Models\InformasiLoker;
use App\Models\KategoriLoker;
use Illuminate\Http\Request;

class InformasiLokerController extends Controller
{
    public function index()
    {
        $informasi_lokers = InformasiLoker::with('kategori')->get();
        return view('admin.informasi_loker.index', compact('informasi_lokers'));
    }

    public function create()
    {
        $kategori_lokers = KategoriLoker::all();
        return view('admin.informasi_loker.create', compact('kategori_lokers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_loker_id' => 'required|exists:kategori_lokers,id',
            'judul'             => 'required|string|max:255',
            'lokasi'            => 'required|string|max:255',
            'gaji'              => 'nullable|string|max:255',
            'persyaratan'       => 'required|string',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        InformasiLoker::create($data);

        return redirect()
            ->route('admin.informasi_loker.index')
            ->with('success', 'Informasi loker berhasil ditambahkan.');
    }

    public function show($id)
    {
        $loker = InformasiLoker::with('kategori')->findOrFail($id);
        return view('admin.informasi_loker.show', compact('loker')); // Kirim variabel $loker
    }

    public function edit(InformasiLoker $informasi_loker)
    {
        $kategori_lokers = KategoriLoker::all();
        return view('admin.informasi_loker.edit', compact('informasi_loker', 'kategori_lokers'));
    }

    public function update(Request $request, $id)
    {
        $loker = InformasiLoker::findOrFail($id);

        $request->validate([
            'kategori_loker_id' => 'required|exists:kategori_lokers,id',
            'judul'             => 'required',
            'lokasi'            => 'required',
            'gaji'              => 'nullable',
            'persyaratan'       => 'required',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($loker->foto) {
                Storage::disk('public')->delete($loker->foto);
            }

            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        $loker->update($data);

        return redirect()
            ->route('admin.informasi_loker.index')
            ->with('success', 'Informasi loker berhasil diperbarui.');
    }

    public function destroy(InformasiLoker $informasi_loker)
    {
        $informasi_loker->delete();
        return redirect()->route('admin.informasi_loker.index')->with('success', 'Informasi loker berhasil dihapus.');
    }
    public function apiShow($id)
{
    $loker = InformasiLoker::with('kategori')->find($id);

    if (!$loker) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $loker
    ]);
}
}
