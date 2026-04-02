<?php
namespace App\Models;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomentarForum extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'isi', 'users_id', 'forum_id', 'is_kasar', 'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }
    public function likes()
{
    return $this->hasMany(KomentarLike::class);
}

public function isLikedBy($user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}

}
