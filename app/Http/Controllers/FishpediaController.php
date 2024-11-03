<?php

namespace App\Http\Controllers;

use App\Models\Fishpedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FishpediaController extends Controller
{
    public function index()
    {
        $fish = Fishpedia::all();
        return view('fishpedia.index', ['title' => 'Fishpedia', 'fish' => $fish]);
    }

    public function create()
    {
        return view('fishpedia.tambahikan', ['title' => 'Tambah Ikan']);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_pasar' => 'required|numeric',
            'gambar_ikan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Menyimpan gambar ke storage jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar_ikan')) {
            $gambarPath = $request->file('gambar_ikan')->store('fishpedia', 'public');
        }

        // Membuat entri baru di database
        Fishpedia::create([
            'nama' => $request->nama,
            'asal' => $request->asal,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'harga_pasar' => $request->harga_pasar,
            'gambar_ikan' => $gambarPath, // Menyimpan path gambar
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fish = Fishpedia::findOrFail($id);
        return view('fishpedia.edit', ['title' => 'Edit Ikan', 'fish' => $fish]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga_pasar' => 'required|numeric',
            'gambar_ikan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $fish = Fishpedia::findOrFail($id);
    
        // Simpan gambar baru jika diunggah
        if ($request->hasFile('gambar_ikan')) {
            // Hapus gambar lama dari storage jika ada
            if ($fish->gambar_ikan) {
                Storage::disk('public')->delete($fish->gambar_ikan);
            }
    
            // Simpan gambar baru
            $gambarPath = $request->file('gambar_ikan')->store('fishpedia', 'public');
            $fish->gambar_ikan = $gambarPath; // Update path gambar
        }
    
        // Update data lainnya
        $fish->nama = $request->nama;
        $fish->jenis = $request->jenis;
        $fish->asal = $request->asal;
        $fish->deskripsi = $request->deskripsi;
        $fish->harga_pasar = $request->harga_pasar;
    
        $fish->save(); // Simpan perubahan
    
        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil diperbarui!');
    }
    

    public function destroy($id)
    {
        $fish = Fishpedia::findOrFail($id);
        $fish->delete();
        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil dihapus!');
    }
}
