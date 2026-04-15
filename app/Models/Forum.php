<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory, SoftDeletes;

    // =========================
    // CONST STATUS (biar konsisten)
    // =========================
    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // =========================
    // FILLABLE
    // =========================
    protected $fillable = [
        'users_id',
        'kategori_forum_id',
        'judul',
        'isi',
        'status',
        'foto',
    ];

    // =========================
    // DEFAULT VALUE
    // =========================
    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    // =========================
    // RELATIONS
    // =========================

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

    // Relasi komentar kasar (termasuk soft delete)
    public function komentarKasar()
    {
        return $this->hasMany(KomentarForum::class, 'forum_id')
            ->where('is_kasar', true)
            ->withTrashed();
    }

    // Relasi like
    public function likes()
    {
        return $this->hasMany(ForumLike::class);
    }

    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // =========================
    // ACCESSOR (BIAR BLADE RAPI)
    // =========================

    // Label status (Pending, Approved, Rejected)
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    // Class CSS untuk badge
    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING  => 'status-pending',
            self::STATUS_APPROVED => 'status-approved',
            self::STATUS_REJECTED => 'status-rejected',
            default               => ''
        };
    }
}
