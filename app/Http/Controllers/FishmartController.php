<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FishmartController extends Controller
{
    //

    public function index() {
        $produk = Produk::all();
        return view('fishmart.index', ['title' => 'Fishmart', 'produk'=> $produk]);
    }

    public function create () {
        return view('fishmart.create', ['title' => 'Fishmart']);
    }

    public function store (Request $request) {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar_produk')) {
            $gambarPath = $request->file('gambar_produk')->store('produk', 'public');
        }
        Produk::create($request->all());

        return redirect()->route('fishmart.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('fishmart.edit', compact('produk'), ['title'=> 'Fishmart']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);

            // Jika ada file gambar yang diunggah, simpan file
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar_produk && Storage::exists('public/' . $produk->gambar_produk)) {
                Storage::delete('public/' . $produk->gambar_produk);
            }

            // Simpan gambar baru
            $filePath = $request->file('gambar_produk')->store('produk', 'public');
            $produk->gambar_produk = $filePath;
        }

    // Update data lainnya
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->stok = $request->stok;
        $produk->harga = $request->harga;

        $produk->save();

        return redirect()->route('fishmart.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('fishmart.show', compact('produk'), ['title'=> 'Fishmart']);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('fishmart.index')->with('success', 'Produk berhasil dihapus.');
    }
}
