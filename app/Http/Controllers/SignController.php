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

        event(new Registered($user));

        // Login user setelah registrasi (opsional)
        Auth::login($user);

        // Redirect ke halaman dashboard atau halaman lain
        return redirect()->route('dashboard')->with('success_login', 'Registrasi berhasil!');
    }

    public function in(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);  // Login the user
            return redirect('dashboard')->with('success_login', 'Login berhasil!');
        } else {
            return back()->with('error_login', 'Email atau password salah.')->withInput();
        }

    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }



}
