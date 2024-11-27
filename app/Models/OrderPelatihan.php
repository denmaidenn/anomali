<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPelatihan extends Model
{
    use HasFactory;

    protected $table = 'order_pelatihans';

    protected $fillable = [
        'user_id',
        'pelatihan_id',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(FormUser::class, 'user_id');
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }
}
