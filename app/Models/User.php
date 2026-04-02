<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',    
        'password',
        'jenis_kelamin',
        'alamat',
        'status',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi: User bisa punya banyak forum
    public function forums()
    {
        return $this->hasMany(Forum::class, 'users_id');
    }

    // Relasi: User bisa punya banyak komentar forum
    public function komentarForum()
    {
        return $this->hasMany(KomentarForum::class, 'users_id');
    }

    // Optional: kalau kamu mau relasi ke lowongan yang dibuat perusahaan
    public function informasiLoker()
    {
        return $this->hasMany(InformasiLoker::class, 'perusahaan_id');
    }
    public function hasRole($role)
{
    return $this->role === $role;
}

}