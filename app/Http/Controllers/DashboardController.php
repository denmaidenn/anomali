<?php

namespace App\Http\Controllers;

use App\Models\FormUser;
use App\Models\Fish;
use App\Models\Pelatihan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class DashboardController extends Controller
{
    //

   

    public function index(Request $request) {
        $data = FormUser::all();
        $fish = Fish::all();
        $pelatihan = Pelatihan::all();
        $produk = Produk::all();

        return view('dashboard', [
            'title' => 'Dashboard',
            'data'=> $data,
            'fish'=> $fish,
            'pelatihan' => $pelatihan,
            'produk'=> $produk
        ]);
    }
}
