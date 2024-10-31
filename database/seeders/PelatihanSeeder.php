<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelatihan;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelatihan::create([
            'id_user' => 1, // Pastikan id_user ini ada di tabel User
            'video_pelatihan' => 'video_link_1.mp4',
            'deskripsi' => 'Pelatihan dasar pemrograman web.',
            'harga' => 50000,
        ]);

        Pelatihan::create([
            'id_user' => 2, // Pastikan id_user ini ada di tabel User
            'video_pelatihan' => 'video_link_2.mp4',
            'deskripsi' => 'Pelatihan lanjut pemrograman mobile.',
            'harga' => 75000,
        ]);

        Pelatihan::create([
            'id_user' => 1,
            'video_pelatihan' => 'video_link_3.mp4',
            'deskripsi' => 'Pelatihan desain UI/UX.',
            'harga' => 60000,
        ]);
    }
}
