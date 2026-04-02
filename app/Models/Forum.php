<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'users_id',
    'kategori_forum_id',
    'judul',
    'isi',
    'status',
    'foto' 
];

    // Relasi ke kategori forum
    public function kategori()
    {
        return $this->belongsTo(KategoriForum::class, 'kategori_forum_id');
    }

    // Relasi ke user (pemilik forum)
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relasi ke komentar forum
    public function komentar()
    {
        return $this->hasMany(KomentarForum::class, 'forum_id');
    }

    // Relasi khusus komentar kasar termasuk yang dihapus (soft deleted)
    public function komentarKasar()
    {
        return $this->hasMany(KomentarForum::class, 'forum_id')
            ->where('is_kasar', true)
            ->withTrashed();
    }
    public function likes()
{
    return $this->hasMany(ForumLike::class);
}
public function isLikedBy($user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}
}
