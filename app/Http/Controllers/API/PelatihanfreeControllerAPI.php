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

        return response()->json([
            'success' => true,
            'message' => 'Pelatihan retrieved successfully',
            'data' => $pelatihan
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
            'video_pelatihan' => 'sometimes|required|string',
            'gambar_pelatihan' => 'nullable|string',
            'deskripsi_pelatihan' => 'sometimes|required|string',
        ]);

        // Update the Pelatihan data
        $pelatihan->update($validatedData);

        return response()->json([
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
