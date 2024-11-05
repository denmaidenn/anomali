<?php

namespace App\Http\Controllers\API;

use App\Models\FormUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileAuthControllerAPI extends Controller
{
    //

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

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    // Method untuk mengambil semua pengguna
    public function index()
    {
        $users = FormUser::all();
        return response()->json($users);
    }

    // Method untuk mengambil pengguna berdasarkan ID
    public function show($id)
    {
        $user = FormUser::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    // Method untuk memperbarui pengguna
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:form_users,email,' . $id,
            'username' => 'sometimes|required|string|max:255|unique:form_users,username,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = FormUser::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Perbarui pengguna
        $user->update($request->all());
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    // Method untuk menghapus pengguna
    public function destroy($id)
    {
        $user = FormUser::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
