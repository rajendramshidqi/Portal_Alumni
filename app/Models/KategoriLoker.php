<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLoker extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug'];

    public function informasiLoker()
    {
        return $this->hasMany(InformasiLoker::class, 'kategori_loker_id');
    }
}
