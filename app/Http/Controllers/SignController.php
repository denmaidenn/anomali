<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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



}
