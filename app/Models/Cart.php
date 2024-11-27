<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    // Relasi ke FormUser
    public function user()
    {
        return $this->belongsTo(FormUser::class, 'user_id', 'id');
    }

    // Relasi ke CartItem
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    // Menghitung total jumlah item dalam keranjang
    public function totalQuantity()
    {
        return $this->items->sum('quantity');
    }

    // Menghitung total harga dari semua item di keranjang
    public function totalPrice()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->produk->harga;
        });
    }
}
