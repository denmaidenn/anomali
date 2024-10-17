<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FishpediaController extends Controller
{
    //

    public function index() {
        return view('fishpedia.index', ['title' => 'Fishpedia']);
    }
}
