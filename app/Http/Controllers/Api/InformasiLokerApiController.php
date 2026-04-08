<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformasiLoker;
use Illuminate\Http\Request;

class InformasiLokerApiController extends Controller
{
    // ✅ GET semua loker
    public function index()
    {
        $lokers = InformasiLoker::with('kategori')->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $lokers,
        ]);
    }

    // ✅ DETAIL
    public function show($id)
    {
        $loker = InformasiLoker::with('kategori')->find($id);

        if (! $loker) {
            return response()->json([
                'success' => false,
                'message' => 'Loker tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $loker,
        ]);
    }

    // ✅ TAMBAH (POST)
    public function store(Request $request)
    {
        $request->validate([
            'kategori_loker_id' => 'required|exists:kategori_lokers,id',
            'judul'             => 'required',
            'lokasi'            => 'required',
            'gaji'              => 'nullable',
            'persyaratan'       => 'required',
        ]);

        $data = $request->all();

        // upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('loker', 'public');
        }

        $loker = InformasiLoker::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Loker berhasil ditambahkan',
            'data'    => $loker,
        ]);
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $loker = InformasiLoker::find($id);

        if (! $loker) {
            return response()->json([
                'success' => false,
                'message' => 'Loker tidak ditemukan',
            ], 404);
        }

        $loker->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Loker berhasil diupdate',
            'data'    => $loker,
        ]);
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $loker = InformasiLoker::find($id);

        if (! $loker) {
            return response()->json([
                'success' => false,
                'message' => 'Loker tidak ditemukan',
            ], 404);
        }

        $loker->delete();

        return response()->json([
            'success' => true,
            'message' => 'Loker berhasil dihapus',
        ]);
    }
}

