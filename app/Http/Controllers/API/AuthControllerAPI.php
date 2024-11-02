<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthControllerAPI extends Controller
{
    /**
     * Membuat akun admin baru.
     */


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
}
