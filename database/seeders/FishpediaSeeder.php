<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fish;

class FishpediaSeeder extends Seeder
{
    public function run()
    {
        Fish::create([
            'name' => 'Koi Slayer',
            'scientific_name' => 'Cyprinus carpio var.',
            'category' => 'Ikan air tawar',
            'origin' => 'Jepang',
            'size' => '30-40cm',
            'characteristics' => 'Sirip panjang, warna cerah',
            'aquarium_size' => 1000,   
            'temperature' => 18,    
            'ph' => 7,              
            'salinity' => 3,  
            'lighting' => 'Kuat/Sedang',
        ]);
    }
}
