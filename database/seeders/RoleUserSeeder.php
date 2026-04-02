<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@example.com',
            'jenis_kelamin'     => 'L',
            'alamat'            => 'Jl. Kekuasaan No.1',
            'status'            => 'active',
            'role'              => 'admin',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ]);

        User::create([
            'name'              => 'Moderator',
            'email'             => 'moderator@example.com',
            'jenis_kelamin'     => 'P',
            'alamat'            => 'Jl. Netral No.2',
            'status'            => 'active',
            'role'              => 'moderator',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ]);

        User::create([
            'name'              => 'Alumni',
            'email'             => 'alumni@example.com',
            'jenis_kelamin'     => 'L',
            'alamat'            => 'Jl. Kenangan No.3',
            'status'            => 'active',
            'role'              => 'alumni',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
        ]);
    }
}
