<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    //

    public function index() {
        $pelatihans = Pelatihan::all();
        return view('pelatihan.index', ['title' => 'Pelatihan', 'pelatihans' => $pelatihans]);
    }

    public function create() {
        return view('pelatihan.create',  ['title' => 'Pelatihan']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video_pelatihan' => 'nullable|string',
            'deskripsi_pelatihan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        Pelatihan::create($request->all());

        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil ditambahkan');
    }
}
