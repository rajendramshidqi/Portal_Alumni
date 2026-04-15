<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\InformasiLoker;
use App\Models\KomentarForum;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // TOTAL DATA
        $jumlahForum    = Forum::count();
        $jumlahLoker    = InformasiLoker::count();
        $jumlahKomentar = KomentarForum::count();

        // KOMENTAR KASAR
        $komentarKasar = KomentarForum::where('is_kasar', 1)->count();

        // DATA BULANAN
        $forumBulanan = Forum::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )->groupBy('bulan')->pluck('total', 'bulan');

        $komentarBulanan = KomentarForum::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )->groupBy('bulan')->pluck('total', 'bulan');

        // AKTIVITAS TERBARU
        $komentarTerbaru = KomentarForum::latest()->take(5)->get();
        $forumTerbaru    = Forum::latest()->take(5)->get();

    

        return view('admin.dashboard', compact(
            'jumlahForum',
            'jumlahLoker',
            'jumlahKomentar',
            'komentarKasar',
            'forumBulanan',
            'komentarBulanan',
            'komentarTerbaru',
            'forumTerbaru',
          
        ));
    }
}
