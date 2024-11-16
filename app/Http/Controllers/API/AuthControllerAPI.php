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
        $user = User::findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'gambar_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Upload gambar jika ada file baru
        if ($request->hasFile('gambar_profile')) {
            $filePath = $request->file('gambar_profile')->store('profile_pictures', 'public');
            $validated['gambar_profile'] = $filePath;
        }
    
        $user->update($validated);
    
        return redirect()->route('admin.index')->with('success', 'User updated successfully!');
    }  
}
