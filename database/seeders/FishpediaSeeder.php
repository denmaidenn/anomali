<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fishpedia;

class FishpediaSeeder extends Seeder
{
    public function run()
    {
        $ikan = Fishpedia::create([
            'nama' => 'Ikan Koi',
            'asal' => 'Jepang',
            'jenis' => 'Hias',
            'deskripsi' => 'Ikan hias yang terkenal dengan warna-warni yang indah.',
            'harga_pasar' => 150000,
            'gambar_ikan' => 'path/to/image.jpg',
        ]);
    }
}
