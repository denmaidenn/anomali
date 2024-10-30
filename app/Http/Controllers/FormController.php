<?php

// FormController.php
namespace App\Http\Controllers;

use App\Models\FormUser;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request (optional but recommended)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'prodi' => 'required|string',
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);

        FormUser::create([
            'name'=> $validatedData['name'],
            'email'=> $validatedData['email'],
            'prodi'=> $validatedData['prodi'],
            'kelas' => $validatedData['kelas'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],

        ]);

        // Pass the submitted data to the view

        return redirect('user.index');
    }

    public function update(Request $request, $id) {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'prodi' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);
    
        // Cari mahasiswa berdasarkan ID
        $mahasiswa = FormUser::find($id);
        $mahasiswa->update($request->all());
    
        return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function delete($id)
    {
        $mahasiswa = FormUser::find($id);

        if ($mahasiswa) {
            $mahasiswa->delete();
            return redirect('user.index')->with('success','data berhasil dihapus.');
        } else {
            return redirect('user.index')->with('error', 'Data tidak ditemukan.');
        }
        
    }
    
}

