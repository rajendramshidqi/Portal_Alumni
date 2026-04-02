<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\InformasiLoker;
use App\Models\KategoriForum;
use App\Models\KategoriLoker;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function showApprovedOnWelcome()
    {
        $forums = Forum::where('status', 'approved')
            ->with('kategori', 'user')
            ->latest()
            ->take(6)
            ->get();

        $informasi_lokers = InformasiLoker::with('kategori')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->latest()
            ->take(6)
            ->get();

        $kategoriLoker   = KategoriLoker::all();
        $kategori_forums = KategoriForum::all();

        return view('welcome', compact(
            'forums',
            'informasi_lokers',
            'kategoriLoker',
            'kategori_forums'
        ));
    }
}
