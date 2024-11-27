<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class FormUser extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'alamat', 
        'no_telp',
        'gambar_profile'
    ];

    protected $hidden = [
        'password',
    ];
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }



    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id', 'id'); // Sesuaikan kolom foreign key jika berbeda
    }

    public function orderPelatihans()
    {
        return $this->hasMany(OrderPelatihan::class, 'user_id');
    }

    public function purchasedPelatihans()
{
    return $this->hasMany(OrderPelatihan::class, 'user_id');
}
    

}
