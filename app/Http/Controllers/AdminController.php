<?php

namespace App\Http\Controllers;
use App\Models\Forum;
use App\Models\InformasiLoker;
use App\Models\KomentarForum;
class AdminController extends Controller
{
    public function index()
{
    $jumlahForum = Forum::count();
    $jumlahLoker = InformasiLoker::count();
    $jumlahKomentar = KomentarForum::count();

    return view('admin.dashboard', compact(
        'jumlahForum',
        'jumlahLoker',
        'jumlahKomentar'
    ));
}

    
}

