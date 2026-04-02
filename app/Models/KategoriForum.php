<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriForum extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug'];

    public function forums()
    {
        return $this->hasMany(Forum::class, 'kategori_forum_id');
    }
}
