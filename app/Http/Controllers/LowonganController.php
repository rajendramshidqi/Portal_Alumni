<?php
namespace App\Http\Controllers;

use App\Models\InformasiLoker;
use App\Models\KategoriLoker;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiLoker::with('kategori');

        // 🔍 SEARCH (judul + gaji)
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

        $informasi_lokers = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // ambil data dropdown
        $lokasiList   = InformasiLoker::select('lokasi')->distinct()->pluck('lokasi');
        $kategoriList = KategoriLoker::all();

        return view('lowongan.index', compact('informasi_lokers', 'lokasiList', 'kategoriList'));
    }
}
