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
            'nama_ilmiah' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'karakteristik' => 'required|string',
            'akuarium' => 'required|string|max:255',
            'suhu_ideal' => 'required|numeric',
            'ph_air' => 'required|numeric',
            'salinitas' => 'required|numeric',
            'pencahayaan' => 'required|string|max:255',
            'gambar_ikan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar_ikan')) {
            $gambarPath = $request->file('gambar_ikan')->store('fishpedia', 'public');
        }

        // Membuat entri baru di database
        Fishpedia::create([
            'nama_ilmiah' => $request->nama_ilmiah,
            'kategori' => $request->kategori,
            'asal' => $request->asal,
            'ukuran' => $request->ukuran,
            'karakteristik' => $request->karakteristik,
            'akuarium' => $request->akuarium,
            'suhu_ideal' => $request->suhu_ideal,
            'ph_air' => $request->ph_air,
            'salinitas' => $request->salinitas,
            'pencahayaan' => $request->pencahayaan,
            'gambar_ikan' => $gambarPath,
        ]);

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
            'nama_ilmiah' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'karakteristik' => 'required|string',
            'akuarium' => 'required|string|max:255',
            'suhu_ideal' => 'required|numeric',
            'ph_air' => 'required|numeric',
            'salinitas' => 'required|numeric',
            'pencahayaan' => 'required|string|max:255',
            'gambar_ikan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fish = Fishpedia::findOrFail($id);

        // Simpan gambar baru jika diunggah
        if ($request->hasFile('gambar_ikan')) {
            if ($fish->gambar_ikan) {
                Storage::disk('public')->delete($fish->gambar_ikan);
            }

            $gambarPath = $request->file('gambar_ikan')->store('fishpedia', 'public');
            $fish->gambar_ikan = $gambarPath;
        }

        // Update data lainnya
        $fish->update($request->only([
            'nama_ilmiah', 'kategori', 'asal', 'ukuran', 'karakteristik', 'akuarium',
            'suhu_ideal', 'ph_air', 'salinitas', 'pencahayaan'
        ]));

        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $fish = Fishpedia::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($fish->gambar_ikan) {
            Storage::disk('public')->delete($fish->gambar_ikan);
        }

        $fish->delete();

        return redirect()->route('fishpedia.index')->with('success', 'Data ikan berhasil dihapus!');
    }
}
