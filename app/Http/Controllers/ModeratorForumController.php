<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\KomentarForum;
use App\Models\User;

class ModeratorForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with(['kategori', 'user'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        $komentarKasarSemua = \App\Models\KomentarForum::with(['forum', 'user'])
            ->where('is_kasar', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $disetujuiBulanIni = Forum::where('status', 'approved')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        return view('moderator.forums.index', compact('forums', 'komentarKasarSemua', 'disetujuiBulanIni'));
    }

    public function approve(Forum $forum)
    {
        $forum->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Forum berhasil di-approve.');
    }

    public function reject(Forum $forum)
    {
        $forum->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'Forum berhasil di-reject.');
    }

    public function destroy($id)
    {
        $komentar = KomentarForum::findOrFail($id);
        $komentar->delete(); // soft delete

        return back()->with('success', 'Komentar berhasil dihapus oleh moderator.');
    }

    public function banUser($id)
    {
        $user         = User::findOrFail($id);
        $user->status = 'banned';
        $user->save();

        return back()->with('success', "User {$user->name} berhasil dibanned.");
    }

    public function unbanUser($id)
    {
        $user         = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'User berhasil di-unban.');
    }

    public function show($id)
    {
        $forum = Forum::with(['kategori', 'user', 'komentarKasar.user'])->findOrFail($id);

        return view('moderator.forums.show', compact('forum'));
    }
}
