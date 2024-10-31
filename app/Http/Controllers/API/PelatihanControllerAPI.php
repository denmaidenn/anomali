<?php

namespace App\Http\Controllers\API;

use App\Models\Pelatihan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelatihanControllerAPI extends Controller
{
    /**
     * Membuat data pelatihan baru.
     */

     
    public function index()
    {
        $pelatihan = Pelatihan::with('user')->get(); // Mengambil semua data pelatihan beserta informasi user yang terkait

        return response()->json([
            'success' => true,
            'message' => 'All Pelatihan retrieved successfully',
            'data' => $pelatihan
        ], 200);
    }

    
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id', // Pastikan id_user ada di tabel users
            'video_pelatihan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Membuat data pelatihan
        $pelatihan = Pelatihan::create([
            'id_user' => $request->id_user,
            'video_pelatihan' => $request->video_pelatihan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pelatihan created successfully',
            'data' => $pelatihan
        ], 201);
    }


    /**
     * Mendapatkan data pelatihan berdasarkan ID.
     */
    public function show($id)
    {
        $pelatihan = Pelatihan::with('user')->find($id); // Mencari data pelatihan berdasarkan ID dengan relasi user

        if (!$pelatihan) {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pelatihan retrieved successfully',
            'data' => $pelatihan
        ], 200);
    }
}
