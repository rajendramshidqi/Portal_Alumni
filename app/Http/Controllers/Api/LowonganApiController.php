<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformasiLoker;
use Illuminate\Http\Request;

class LowonganApiController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiLoker::with('kategori');

        // 🔍 SEARCH
        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                    ->orWhere('gaji', 'like', '%' . $request->keyword . '%');
            });
        }

        // 📍 FILTER LOKASI
        if ($request->lokasi) {
            $query->where('lokasi', $request->lokasi);
        }

        // 🏷️ FILTER KATEGORI
        if ($request->kategori) {
            $query->where('kategori_loker_id', $request->kategori);
        }

        $lokers = $query->latest()->paginate(12);

        return response()->json([
            'success' => true,
            'data'    => $lokers,
        ]);
    }

    // 🔍 DETAIL
    public function show($id)
    {
        $loker = InformasiLoker::with('kategori')->find($id);

        if (! $loker) {
            return response()->json([
                'success' => false,
                'message' => 'Lowongan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $loker,
        ]);
    }
}
