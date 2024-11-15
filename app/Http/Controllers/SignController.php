<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class SignController extends Controller
{
    // Tampilkan form login
    public function index() {
        return view('sign.index');
    }

    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register.index');  // View untuk form registrasi
    }

    // Menangani registrasi pengguna
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
            'role' => 'admin',  // Menetapkan peran admin saat registrasi
        ]);

        // Login user setelah registrasi
        Auth::login($user);

        // Redirect ke halaman login atau dashboard
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    // Menangani login pengguna
    public function in(Request $request)
    {
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

            // Buat token setelah login
            $token = $user->createToken('token_name')->plainTextToken;

            // Memeriksa dan menetapkan peran admin
            if ($user->role !== 'admin') {
                $user->role = 'admin';
                $user->save();
            }

            // Redirect ke dashboard dengan token
            return redirect('dashboard')->with([
                'success_login' => 'Login berhasil!',
                'token' => $token
            ]);
        } else {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }
    }

    // Menangani logout pengguna
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
