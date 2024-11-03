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
            'no_telp' => 'required|string|unique:form_users',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:form_users',
            'username' => 'required|string|unique:form_users',
            'password' => 'required|string|min:8',
        ]);
    
        // Create a new FormUser instance and save it to the database
        FormUser::create([
            'no_telp' => $request->no_telp,
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);
    
        return redirect()->route('user.index')->with('success', 'Data telah berhasil ditambah!');
    }
    

    public function update(Request $request, $id) {
        // Validasi input
        $formUser = FormUser::find($id);
    
        $request->validate([
            'no_telp' => 'required|string|unique:form_users,no_telp,' . $formUser->id,
            'name' => 'required|string',
            'email' => 'required|string|email|unique:form_users,email,' . $formUser->id,
            'username' => 'required|string|unique:form_users,username,' . $formUser->id,
            'password' => 'nullable|string|min:8', // Password tidak wajib diisi saat update
        ]);
    
        // Update data form user
        $formUser->update($request->all());
    
        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }
     

    public function delete($id)
    {
        $formUser = FormUser::find($id);

        if ($formUser) {
            $formUser->delete();
            return redirect()->route('user.index')->with('success','data berhasil dihapus.');
        } else {
            return redirect()->route('user.index')->with('error', 'Data tidak ditemukan.');
        }
        
    }
    
}

