<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FishpediaSeeder extends Seeder
{
    public function run()
    {
        DB::table('fishpedias')->insert([
            [
                'nama' => 'Guppy',
                'nama_ilmiah' => 'Poecilia reticulata',
                'kategori' => 'Ikan Hias Air Tawar',
                'asal' => 'Amerika Selatan',
                'ukuran' => '2-5 cm',
                'karakteristik' => 'Ikan kecil yang berwarna-warni dan damai.',
                'akuarium' => 20,
                'suhu_ideal' => 24,
                'ph_air' => 7.5,
                'salinitas' => 'Tawar',
                'pencahayaan' => 'Sedang',
                'gambar_ikan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Clownfish',
                'nama_ilmiah' => 'Amphiprioninae',
                'kategori' => 'Ikan Hias Air Laut',
                'asal' => 'Indo-Pasifik',
                'ukuran' => '10-15 cm',
                'karakteristik' => 'Ikan yang suka bersembunyi di anemon laut.',
                'akuarium' => 50,
                'suhu_ideal' => 26,
                'ph_air' => 8.2,
                'salinitas' => 'Laut',
                'pencahayaan' => 'Tinggi',
                'gambar_ikan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more fish records here as needed
        ]);
    }
}
