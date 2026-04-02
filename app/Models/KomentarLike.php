<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarLike extends Model
{
    protected $fillable = ['komentar_forum_id', 'user_id'];

    public function komentar()
    {
        return $this->belongsTo(KomentarForum::class);
    }
}
