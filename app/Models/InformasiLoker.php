<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiLoker extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_loker_id', 'judul', 'lokasi', 'gaji', 'persyaratan','foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriLoker::class, 'kategori_loker_id');
    }
}
