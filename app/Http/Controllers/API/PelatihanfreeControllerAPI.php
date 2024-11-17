<?php

namespace App\Http\Controllers\API;

use App\Models\Pelatih;
use App\Models\PelatihanFree;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelatihanfreeControllerAPI extends Controller
{
    //

    public function index()
    {
        $pelatihan = PelatihanFree::with('user')->get();

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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Store the Pelatihan record
        $pelatihan = PelatihanFree::create([
            'id_user' => $request->id_user,
            'judul' => $request->judul,
            'video_pelatihan' => $request->video_pelatihan,
            'gambar_pelatihan' => $request->gambar_pelatihan, // Store image URL as string (not file upload)
            'deskripsi_pelatihan' => $request->deskripsi_pelatihan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pelatihan created successfully',
            'data' => $pelatihan
        ], 201);
    }

    public function show($id)
    {
        $pelatihan = PelatihanFree::with('user')->find($id);

        if (!$pelatihan) {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan not found'
            ], 404);
        }

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
        $pelatihan = PelatihanFree::find($id);
        if (!$pelatihan) {
            return response()->json(['message' => 'Pelatihan not found'], 404);
        }

        $validatedData = $request->validate([
            'id_user' => 'sometimes|required|exists:pelatih,id',
            'judul' => 'sometimes|required|string|max:255',
            'video_pelatihan' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // Validasi untuk video
            'gambar_pelatihan' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
            'deskripsi_pelatihan' => 'sometimes|required|string',
        ]);

        // Update the Pelatihan data
        if ($request->hasFile('video_pelatihan')) {
            $videoPath = $request->file('video_pelatihan')->store('videos_pelatihan', 'public');
            $pelatihan->video_pelatihan = $videoPath;
        }
    
        // Handle gambar upload jika ada gambar yang diunggah
        if ($request->hasFile('gambar_pelatihan')) {
            $gambarPath = $request->file('gambar_pelatihan')->store('pelatihan', 'public');
            $pelatihan->gambar_pelatihan = $gambarPath;
        }

        $pelatihan->id_user = $validatedData['id_user'] ?? $pelatihan->id_user;
        $pelatihan->judul = $validatedData['judul'] ?? $pelatihan->judul;
        $pelatihan->deskripsi_pelatihan = $validatedData['deskripsi_pelatihan'] ?? $pelatihan->deskripsi_pelatihan;

        $pelatihan->save();


        return response()->json([
            'success' => true,
            'message' => 'Pelatihan updated successfully',
            'data' => $pelatihan
        ]);
    }

    public function delete($id)
    {
        $pelatihan = PelatihanFree::find($id);
        if (!$pelatihan) {
            return response()->json(['message' => 'Pelatihan not found'], 404);
        }

        // Delete the Pelatihan record
        $pelatihan->delete();
        return response()->json(['message' => 'Pelatihan deleted successfully']);
    }
}
