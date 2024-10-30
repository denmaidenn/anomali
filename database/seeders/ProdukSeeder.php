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
        //

        $produk = [
            [
                'nama_produk' => 'Ikan Koi',
                'deskripsi_produk' => 'Ikan koi cantik dengan warna yang cerah.',
                'gambar_produk' => 'produk/koi.jpg', // Pastikan gambar tersedia di direktori yang benar
                'stok' => 50,
                'harga' => 75000.00,
            ],
            [
                'nama_produk' => 'Ikan Cupang',
                'deskripsi_produk' => 'Ikan cupang dengan sirip yang indah.',
                'gambar_produk' => 'produk/cupang.jpg',
                'stok' => 100,
                'harga' => 25000.00,
            ],
            [
                'nama_produk' => 'Ikan Arwana',
                'deskripsi_produk' => 'Ikan arwana eksotis yang langka.',
                'gambar_produk' => 'produk/arwana.jpg',
                'stok' => 20,
                'harga' => 1500000.00,
            ],
        ];

        foreach ($produk as $item) {
            Produk::create($item);
        }
    }
}
