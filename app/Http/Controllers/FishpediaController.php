<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;

class FishpediaController extends Controller
{
    public function index()
    {
        $fish = Fish::all();
        return view('fishpedia.index', ['title' => 'Fishpedia', 'fish' => $fish]);
    }

    public function create()
    {
        return view('fishpedia.tambahikan', ['title' => 'Tambah Ikan']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_pasar' => 'required|numeric',
        ]);

        Fish::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'asal' => $request->asal,
            'deskripsi' => $request->deskripsi,
            'harga_pasar' => $request->harga_pasar,
        ]);

        return redirect()->route('fishpedia.index')->with('success', 'Data telah berhasil ditambah!');
    }

    public function edit($id)
    {
        $fish = Fish::findOrFail($id);
        return view('fishpedia.edit', ['title' => 'Edit Ikan', 'fish' => $fish]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_pasar' => 'required|numeric',
        ]);

        $fish = Fish::findOrFail($id);
        $fish->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'asal' => $request->asal,
            'deskripsi' => $request->deskripsi,
            'harga_pasar' => $request->harga_pasar,
        ]);

        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $fish = Fish::findOrFail($id);
        $fish->delete();
        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil dihapus!');
    }
}
