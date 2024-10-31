<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //

    public function index()
    {
        $transaksi = Transaksi::with('user', 'produk')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        $users = User::all();
        $produk = Produk::all();
        return view('transaksi.create', compact('users', 'produk'));
    }

    // Menyimpan transaksi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_produk' => 'required|exists:produk,id_produk',
            'status_transaksi' => 'required|in:pending,completed,cancelled',
            'tanggal' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $users = User::all();
        $produk = Produk::all();
        return view('transaksi.edit', compact('transaksi', 'users', 'produk'));
    }

    // Memperbarui data transaksi di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_produk' => 'required|exists:produk,id_produk',
            'status_transaksi' => 'required|in:pending,completed,cancelled',
            'tanggal' => 'required|date',
            'total_harga' => 'required|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Menghapus transaksi dari database
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}



