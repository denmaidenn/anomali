<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fish;

class FishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data dummy
        Fish::create([
            'name' => 'Nemo',
            'scientific_name' => 'Amphiprioninae',
            'category' => 'Clownfish',
            'origin' => 'Great Barrier Reef',
            'size' => 10,
            'characteristics' => 'Bright orange with white bands.',
            'aquarium_size' => 100.0,
            'temperature' => 24,
            'ph' => 8,
            'salinity' => 1.025,
            'lighting' => 'Medium',
        ]);

        Fish::create([
            'name' => 'Dory',
            'scientific_name' => 'Paracanthurus hepatus',
            'category' => 'Regal Blue Tang',
            'origin' => 'Coral reefs of the Indo-Pacific',
            'size' => 25,
            'characteristics' => 'Bright blue with yellow fins.',
            'aquarium_size' => 150.0,
            'temperature' => 22,
            'ph' => 8.1,
            'salinity' => 1.020,
            'lighting' => 'High',
        ]);

        Fish::create([
            'name' => 'Guppy',
            'scientific_name' => 'Poecilia reticulata',
            'category' => 'Freshwater Fish',
            'origin' => 'Northeast South America',
            'size' => 5,
            'characteristics' => 'Colorful and small, easy to breed.',
            'aquarium_size' => 40.0,
            'temperature' => 24,
            'ph' => 7.0,
            'salinity' => 1.000,
            'lighting' => 'Low',
        ]);
    }
}
