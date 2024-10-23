<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FishpediaController extends Controller
{
    //

    public function index() {
        $fishes = Fish::all(); // Mengambil semua data ikan
        return view('fishpedia.fish', compact('fishes')); // Mengirim data ikan ke view
    }

}
