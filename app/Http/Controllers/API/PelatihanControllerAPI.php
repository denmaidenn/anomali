<?php

namespace App\Http\Controllers\API;

use App\Models\Pelatihan;
use App\Models\Pelatih;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelatihanControllerAPI extends Controller
{
    public function index()
    {
        $pelatihan = Pelatihan::with('user')->get();

        return response()->json([
            'success' => true,
            'message' => 'All Pelatihan retrieved successfully',
            'data' => $pelatihan
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:pelatih,id',
            'judul' => 'required|string|max:255',
            'video_pelatihan' => 'required|string|max:255',
            'gambar_pelatihan' => 'nullable|string',
            'deskripsi_pelatihan' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Store the Pelatihan record
        $pelatihan = Pelatihan::create([
            'id_user' => $request->id_user,
            'judul' => $request->judul,
            'video_pelatihan' => $request->video_pelatihan,
            'gambar_pelatihan' => $request->gambar_pelatihan, // Store image URL as string (not file upload)
            'deskripsi_pelatihan' => $request->deskripsi_pelatihan,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pelatihan created successfully',
            'data' => $pelatihan
        ], 201);
    }

    public function show($id)
    {
        $pelatihan = Pelatihan::with('user')->find($id);
    
        if (!$pelatihan) {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan not found'
            ], 404);
        }
    
        // Ambil semua pelatih untuk dropdown
        $pelatih = Pelatih::all(['id', 'nama']); // Ganti dengan model User atau Pelatih yang sesuai
    
        return response()->json([
            'success' => true,
            'message' => 'Pelatihan retrieved successfully',
            'data' => $pelatihan,
            'pelatih' => $pelatih, // Tambahkan data pelatih
        ], 200);
    }
    
    

    public function update(Request $request, $id)
    {
        $pelatihan = Pelatihan::find($id);
        if (!$pelatihan) {
            return response()->json(['message' => 'Pelatihan not found'], 404);
        }
    
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_user' => 'sometimes|required|exists:pelatih,id',
            'judul' => 'sometimes|required|string|max:255',
            'video_pelatihan' => 'nullable|file|mimes:mp4,mov,avi|max:102400', // Validasi untuk video
            'gambar_pelatihan' => 'nullable|file|mimes:jpeg,png,jpg|max:10240', // Validasi file gambar
            'deskripsi_pelatihan' => 'sometimes|required|string',
            'harga' => 'sometimes|required|numeric',
        ]);
    
        // Handle video upload jika ada video yang diunggah
        if ($request->hasFile('video_pelatihan')) {
            $videoPath = $request->file('video_pelatihan')->store('videos_pelatihan', 'public');
            $pelatihan->video_pelatihan = $videoPath;
        }
    
        // Handle gambar upload jika ada gambar yang diunggah
        if ($request->hasFile('gambar_pelatihan')) {
            $gambarPath = $request->file('gambar_pelatihan')->store('pelatihan', 'public');
            $pelatihan->gambar_pelatihan = $gambarPath;
        }
    
        // Update data lainnya
        $pelatihan->id_user = $validatedData['id_user'] ?? $pelatihan->id_user;
        $pelatihan->judul = $validatedData['judul'] ?? $pelatihan->judul;
        $pelatihan->deskripsi_pelatihan = $validatedData['deskripsi_pelatihan'] ?? $pelatihan->deskripsi_pelatihan;
        $pelatihan->harga = $validatedData['harga'] ?? $pelatihan->harga;
        
        // Simpan perubahan ke database
        $pelatihan->save();
    
        // Mengembalikan respons JSON dengan data pelatihan yang diperbarui
        return response()->json([
            'success' => true,
            'message' => 'Pelatihan updated successfully',
            'data' => $pelatihan
        ]);
    }
    

    public function delete($id)
    {
        $pelatihan = Pelatihan::find($id);
        if (!$pelatihan) {
            return response()->json(['message' => 'Pelatihan not found'], 404);
        }

        // Delete the Pelatihan record
        $pelatihan->delete();
        return response()->json(['message' => 'Pelatihan deleted successfully']);
    }
}
