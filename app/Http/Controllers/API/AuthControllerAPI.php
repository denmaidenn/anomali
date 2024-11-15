<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthControllerAPI extends Controller
{
    /**
     * Login pengguna dan membuat token.
     */
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
            // Login pengguna
            Auth::login($user);

            // Buat token setelah login
            $token = $user->createToken('token_name')->plainTextToken;

            // Memeriksa dan menetapkan peran jika tidak `admin`
            if ($user->role !== 'admin') {
                $user->role = 'admin';
                $user->save();
            }

            // Kirim respons JSON dengan token dan informasi tambahan
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'token' => $token,
                'user' => $user,
            ], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Email atau password salah.'], 401);
        }
    }

    /**
     * Mengambil semua data pengguna.
     */
    public function index()
    {
        // Mengambil semua data pengguna
        $admins = User::all();

        return response()->json([
            'success' => true,
            'message' => 'Semua pengguna berhasil diambil',
            'data' => $admins,
        ], 200);
    }

    /**
     * Menyimpan data pengguna baru.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Membuat pengguna baru dengan hash password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role' => 'admin', // Menetapkan peran sebagai admin
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil dibuat',
            'data' => $user,
        ], 201);
    }

    /**
     * Mendapatkan data pengguna berdasarkan ID.
     */
    public function show($id)
    {
        // Mencari data pengguna berdasarkan ID
        $admin = User::find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil diambil',
            'data' => $admin,
        ], 200);
    }

    /**
     * Memperbarui data pengguna.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Memperbarui nama dan email pengguna
        $user->update($request->only(['name', 'email']));

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil diperbarui',
            'data' => $user,
        ], 200);
    }

    /**
     * Menghapus data pengguna.
     */
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil dihapus',
        ], 200);
    }
}
