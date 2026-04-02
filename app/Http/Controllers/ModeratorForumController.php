<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\KomentarForum;
use App\Models\User;

class ModeratorForumController extends Controller
{
    public function index()
    {
        // Load forum yang pending dan eager load relasi termasuk komentar kasar
        $forums = Forum::with(['kategori', 'user', 'komentarKasar.user'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('moderator.forums.index', compact('forums'));
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
