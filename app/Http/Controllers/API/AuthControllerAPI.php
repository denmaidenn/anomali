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
     * Membuat akun admin baru.
     */
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
            // Login pengguna
            Auth::login($user);
    
            // Membuat token setelah login
            $token = $user->createToken('token_name')->plainTextToken;
    
            // Kirim respons JSON dengan token
            return response()->json([
                'message' => 'Login berhasil!',
                'token' => $token,
            ]);
        } else {
            return response()->json(['message' => 'Email atau password salah.'], 401);
        }
    }
    

    public function index()
    {
        // Mengambil semua data pengguna
        $admins = User::all();

        return response()->json([
            'success' => true,
            'message' => 'All Users retrieved successfully',
            'data' => $admins
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
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
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => $admin
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->only(['name', 'email']));

        return response()->json($user, 200);
    }   
}
