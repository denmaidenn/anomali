<?php

namespace App\Http\Controllers\API;

use App\Models\FormUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MobileAuthControllerAPI extends Controller
{

    //

    // Method untuk mengambil semua pengguna
    public function index()
    {
        $users = FormUser::all();
        return response()->json($users);
    }
    

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:form_users',
            'username' => 'required|string|max:255|unique:form_users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat pengguna baru
        $user = FormUser::create($request->all());

        return response()->json(['success' => true, 'message' => 'User created successfully', 'user' => $user], 201);
    }

    


    // Method untuk mengambil pengguna berdasarkan ID
    public function show($id)
    {
        $user = FormUser::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'User data retrieved successfully',
            'data' => $user
        ], 200);
    }

    // Method untuk memperbarui pengguna
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:form_users,email,' . $id,
            'username' => 'sometimes|required|string|max:255|unique:form_users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'gambar_profile' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user = FormUser::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        if ($request->hasFile('gambar_profile')) {
            if ($user->gambar_profile) {
                Storage::disk('public')->delete($user->gambar_profile);
            }
            $profilePicturePath = $request->file('gambar_profile')->store('profile_pictures', 'public');
            $user->gambar_profile = $profilePicturePath;
        }
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->fill($request->except('gambar_profile', 'password'))->save();
    
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }
    

    // Method untuk menghapus pengguna
    public function delete($id)
    {
        $user = FormUser::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Mencari pengguna berdasarkan email
        $user = FormUser::where('email', $request->email)->first();

        // Memeriksa apakah pengguna ditemukan dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // Membuat token untuk pengguna
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function updatePaymentInfo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = FormUser::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->only('no_telp', 'alamat'));
        return response()->json(['message' => 'Payment info updated successfully']);
    }

    public function updatePicture(Request $request, $id)
    {
        // Validate if the request contains a file and if it's an image
        $request->validate([
            'gambar_profile' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the user by id
        $user = FormUser::find($id);
        
        // If user not found, return an error response
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Check if a new picture is uploaded
        if ($request->hasFile('gambar_profile')) {
            // If the user already has a profile picture, delete the old one
            if ($user->gambar_profile) {
                Storage::disk('public')->delete($user->gambar_profile);
            }

            // Store the new image in the 'profile_pictures' directory
            $gambarPath = $request->file('gambar_profile')->store('profile_pictures', 'public');

            // Update the user's profile picture field
            $user->gambar_profile = $gambarPath;
            $user->save(); // Save the user with the updated profile picture

            // Return a success response with the new picture path
            return response()->json(['message' => 'Profile picture updated successfully.', 'data' => $user], 200);
        }

        // If no file was uploaded, return a validation error
        return response()->json(['message' => 'No image file uploaded.'], 400);
    }

}

