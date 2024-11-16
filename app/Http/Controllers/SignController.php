<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class SignController extends Controller
{
    //

    public function index() {
        return view('sign.index');
    }

    public function showRegisterForm()
    {
        return view('register.index');  // View untuk form register
    }

    // Menangani register user
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',  // Harus ada konfirmasi password
        ]);

        // Membuat user baru dan otomatis meng-hash password
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),  // Otomatis akan di-hash oleh mutator di model User
        ]);


        // Login user setelah registrasi (opsional)
        Auth::login($user);

        // Redirect ke halaman dashboard atau halaman lain
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function in(Request $request) {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Mencari pengguna berdasarkan email
        $user = User::where('email', $request->input('email'))->first();
    
        // Memeriksa apakah pengguna ditemukan dan password cocok
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);  // Login pengguna
    
            // Membuat token setelah login
            $token = $user->createToken('token_name')->plainTextToken;
    
            // Redirect ke dashboard dengan token untuk digunakan di Postman
            return redirect('dashboard')->with([
                'success_login' => 'Login berhasil!',
                'token' => $token // Anda bisa menampung token di session atau mengembalikannya ke view
            ]);
        } else {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }
    }

    public function logout(Request $request) {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // password is optional
            'gambar_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);
    
        // Find the user by ID
        $user = User::findOrFail($id);
    
        // Handle profile image upload if present
        if ($request->hasFile('gambar_profile')) {
            // Delete old image if it exists
            if ($user->gambar_profile) {
                Storage::disk('public')->delete($user->gambar_profile);
            }
    
            // Store new image
            $validatedData['gambar_profile'] = $request->file('gambar_profile')->store('gambar_admin', 'public');
        }
    
        // If a password is provided, hash and include it in the update data
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // If no password is provided, remove it from the validated data to prevent updating it to null
            unset($validatedData['password']);
        }
    
        // Update user data with validated data
        $user->update($validatedData);
    
        // Redirect with success message
        return redirect()->route('dashboard')->with('success_login', 'Data Admin berhasil diperbarui.');
    }
    
    

    public function edit($id) 
    {
    // Temukan user berdasarkan ID
    $user = User::findOrFail($id);

    // Return view dengan data user
    return view('sign.edit', compact('user'), ['title' =>'Admin']);
    }

    public function show($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Return the view with the user data
    return view('sign.show', compact('user'), ['title' =>'Admin']);
}

public function delete($id)
{
    // Mencari user berdasarkan ID
    $user = User::findOrFail($id);

    // Hapus data user
    $user->delete();

    // Redirect dengan pesan sukses setelah penghapusan
    return redirect()->route('user.index')->with('success', 'Admin berhasil dihapus.');
}



}
