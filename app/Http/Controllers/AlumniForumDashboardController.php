<?php
namespace App\Http\Controllers;
use App\Models\KomentarForum;

use App\Models\Forum;
use App\Models\KategoriForum;
use Illuminate\Support\Facades\Auth;

class AlumniForumDashboardController extends Controller
{
    public function index()
    {
        $forums = Forum::where('users_id', auth()->id())->latest()->get();


        $kategori_forums = KategoriForum::all();

      $forumIds = $forums->pluck('id');

        $notif = KomentarForum::with('user', 'forum')
        ->whereIn('forum_id', $forumIds)
        ->where('is_read', false)
        ->latest()
        ->take(5)
        ->get();

        return view('alumni.forums.dashboard', compact('forums','kategori_forums', 'notif'));
    }
    public function bacaNotif()
        {
            $forums = Forum::where('users_id', auth()->id())->pluck('id');

            KomentarForum::whereIn('forum_id', $forums)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json(['status' => 'success']);
}
}
