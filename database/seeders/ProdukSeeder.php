<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan beberapa data produk
        Produk::create([
            'nama_produk' => 'Filter Air Super Clear',
            'deskripsi_produk' => 'Filter air untuk akuarium berukuran kecil hingga sedang, menyaring dengan efektif.',
            'gambar_produk' => 'filter-air-super-clear.jpg', // Ganti dengan path gambar yang valid
            'stok' => 100,
            'harga' => 150000,
            'kategori' => 'Filter Air',
        ]);

        Produk::create([
            'nama_produk' => 'Pakan Ikan Kecil',
            'deskripsi_produk' => 'Pakan ikan kecil dengan kandungan protein tinggi, cocok untuk ikan hias.',
            'gambar_produk' => 'pakan-ikan-kecil.jpg', // Ganti dengan path gambar yang valid
            'stok' => 200,
            'harga' => 50000,
            'kategori' => 'Pakan',
        ]);

        Produk::create([
            'nama_produk' => 'Tanaman Hias Air',
            'deskripsi_produk' => 'Tanaman hias air untuk mempercantik akuarium Anda.',
            'gambar_produk' => 'tanaman-hias-air.jpg', // Ganti dengan path gambar yang valid
            'stok' => 50,
            'harga' => 25000,
            'kategori' => 'Tanaman Hias',
        ]);

        Produk::create([
            'nama_produk' => 'Batu Coral',
            'deskripsi_produk' => 'Batu coral alami untuk dekorasi akuarium.',
            'gambar_produk' => 'batu-coral.jpg', // Ganti dengan path gambar yang valid
            'stok' => 75,
            'harga' => 80000,
            'kategori' => 'Batu Coral',
        ]);

        Produk::create([
            'nama_produk' => 'Aquascape Rocks',
            'deskripsi_produk' => 'Batu aquascape yang indah dan cocok untuk penataan akuarium yang elegan.',
            'gambar_produk' => 'aquascape-rocks.jpg', // Ganti dengan path gambar yang valid
            'stok' => 30,
            'harga' => 120000,
            'kategori' => 'Aquascape',
        ]);
    }
}
