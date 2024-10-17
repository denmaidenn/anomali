<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    //

    public function index() {
        return view('pelatihan.index', ['title' => 'Pelatihan']);
    }
}
