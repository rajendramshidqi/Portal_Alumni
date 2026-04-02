<?php

namespace App\Http\Controllers;
use App\Models\KomentarLike;

use Illuminate\Http\Request;

class KomentarLikeController extends Controller
{
    public function toggle($komentarId)
{
    $like = KomentarLike::where('komentar_forum_id', $komentarId)
        ->where('user_id', auth()->id())
        ->first();

    if ($like) {
        $like->delete();
    } else {
        KomentarLike::create([
            'komentar_forum_id' => $komentarId,
            'user_id' => auth()->id()
        ]);
    }

    return back();
}

}
