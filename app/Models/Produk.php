<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'deskripsi_produk',
        'gambar_produk',
        'stok',
        'harga',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
}
