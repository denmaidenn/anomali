<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::all();
        return view('pelatihan.create',  ['title' => 'Pelatihan', 'users' => $users]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required|exists:users,id',
            'video_pelatihan' => 'required|string',
            'deskripsi_pelatihan' => 'required|string',
            'harga' => 'required|numeric',
        ]);
            Pelatihan::create([
                'id_user' => $validatedData['id_user'],
                'video_pelatihan'=> $validatedData['video_pelatihan'],
                'deskripsi_pelatihan' => $validatedData['deskripsi_pelatihan'],
                'harga'=> $validatedData['harga'],
            ]);


            return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil ditambahkan');

    }

    public function edit($id)
    {
        // Mengambil data pelatihan berdasarkan id
        $pelatihan = Pelatihan::findOrFail($id);
        $users = User::all();

        return view('pelatihan.edit', compact('pelatihan', 'users'), ['title'=> 'Pelatihan']);
    }

    public function update(Request $request, $id) {
    // Validasi data
    $request->validate([
        'id_user' => 'required|exists:users,id',
        'video_pelatihan' => 'required|string',
        'deskripsi_pelatihan' => 'required|string',
        'harga' => 'required|numeric',
    ]);

        // Cari data pelatihan berdasarkan ID
        $pelatihan = Pelatihan::findOrFail($id);

        // Update data pelatihan dengan data yang baru
        $pelatihan->update([
            'id_user' => $request->id_user,
            'video_pelatihan' => $request->video_pelatihan,
            'deskripsi_pelatihan' => $request->deskripsi_pelatihan,
            'harga' => $request->harga,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pelatihan.index')->with('success', 'Data pelatihan berhasil diperbarui.');

}

    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->delete();

        return redirect()->route('pelatihan.index')->with('success', 'Data pelatihan berhasil dihapus!');
    }
}
