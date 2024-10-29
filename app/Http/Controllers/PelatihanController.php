<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    //

    public function index() {
        $pelatihan = Pelatihan::all();
        return view('pelatihan.index', ['title' => 'Pelatihan', 'pelatihan' => $pelatihan]);
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

    public function show($id)
    {
        // Mengambil data pelatihan berdasarkan id
        $pelatihan = Pelatihan::findOrFail($id);

        return view('pelatihan.show', compact('pelatihan'), ['title'=> 'Pelatihan']);
    }

    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->delete();

        return redirect()->route('pelatihan.index')->with('success', 'Data pelatihan berhasil dihapus!');
    }
}
