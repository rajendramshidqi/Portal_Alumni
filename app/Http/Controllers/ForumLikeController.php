<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumLikeController extends Controller
{
    public function toggle($forumId)
{
    $like = ForumLike::where('forum_id', $forumId)
        ->where('user_id', auth()->id())
        ->first();

    if ($like) {
        $like->delete();
    } else {
        ForumLike::create([
            'forum_id' => $forumId,
            'user_id' => auth()->id()
        ]);
    }

    return back();
}

}
