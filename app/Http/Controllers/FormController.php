<?php

namespace App\Http\Controllers;

use App\Models\FormUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request (optional but recommended)
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:form_users',
            'username' => 'required|string|unique:form_users',
            'password' => 'required|string|min:8',
        ]);
    
        // Create a new FormUser instance and save it to the database
        FormUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Encrypt password
        ]);
    
        return redirect()->route('user.index')->with('success', 'Data telah berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $formUser = FormUser::find($id);
        if (!$formUser) {
            return redirect()->route('user.index')->with('error', 'Data tidak ditemukan.');
        }

        // Validate all profile fields
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:form_users,email,' . $formUser->id,
            'username' => 'sometimes|required|string|unique:form_users,username,' . $formUser->id,
            'password' => 'nullable|string|min:8',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'gambar_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle profile picture upload if present
        if ($request->hasFile('gambar_profile')) {
            if ($formUser->gambar_profile) {
                Storage::disk('public')->delete($formUser->gambar_profile);
            }
            $profilePicturePath = $request->file('gambar_profile')->store('profile_pictures', 'public');
            $formUser->gambar_profile = $profilePicturePath;
        }

        // Update all other profile fields
        $formUser->name = $request->name ?? $formUser->name;
        $formUser->email = $request->email ?? $formUser->email;
        $formUser->username = $request->username ?? $formUser->username;
        $formUser->no_telp = $request->no_telp ?? $formUser->no_telp;
        $formUser->alamat = $request->alamat ?? $formUser->alamat;
        if ($request->filled('password')) {
            $formUser->password = bcrypt($request->password);
        }

        $formUser->save();

        return redirect()->route('user.index')->with('success', 'Data profil berhasil diperbarui!');
    }

    public function delete($id)
    {
        $formUser = FormUser::find($id);

        if ($formUser) {
            $formUser->delete();
            return redirect()->route('user.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('user.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function updatePaymentInfo(Request $request, $id)
    {
        // Validate phone and address only
        $request->validate([
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $formUser = FormUser::find($id);
        if (!$formUser) {
            return redirect()->route('user.index')->with('error', 'Data tidak ditemukan.');
        }

        // Update only phone and address fields
        $formUser->update([
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('user.index')->with('success', 'Data pembayaran berhasil diperbarui!');
    }
}
