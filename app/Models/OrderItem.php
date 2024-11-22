<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'produk_id',
        'quantity',
        'price'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
