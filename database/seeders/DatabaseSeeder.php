<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Akun User (Siswa)
        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@perpus.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Data Buku
        Buku::create([
            'kode_buku' => 'BK-001',
            'judul' => 'Pemrograman Web Laravel',
            'pengarang' => 'Eko Kurniawan',
            'penerbit' => 'Media Ilmu',
            'stok' => 5,
        ]);

        Buku::create([
            'kode_buku' => 'BK-002',
            'judul' => 'Belajar MySQL',
            'pengarang' => 'Budi Raharjo',
            'penerbit' => 'Informatika',
            'stok' => 3,
        ]);
    }
}