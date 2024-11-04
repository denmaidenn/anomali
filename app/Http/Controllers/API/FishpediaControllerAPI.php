<?php

namespace App\Http\Controllers\API;

use App\Models\Fishpedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FishpediaControllerAPI extends Controller
{
    /**
     * Mendapatkan semua data Fishpedia.
     */
    public function index()
    {
        $fishpedia = Fishpedia::all(); // Mengambil semua data fishpedia

        return response()->json([
            'success' => true,
            'message' => 'All Fishpedia entries retrieved successfully',
            'data' => $fishpedia
        ], 200);
    }

    /**
     * Membuat data Fishpedia baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'asal' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama' => 'required|string|max:255',
            'id_ikan' => 'required|integer',
            'harga_pasar' => 'required|numeric|min:0',
            'gambar_ikan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Membuat data fishpedia
        $fishpedia = Fishpedia::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Fishpedia entry created successfully',
            'data' => $fishpedia
        ], 201);
    }

    /**
     * Mendapatkan data Fishpedia berdasarkan ID.
     */
    public function show($id)
    {
        $fishpedia = Fishpedia::find($id); // Mencari data fishpedia berdasarkan ID

        if (!$fishpedia) {
            return response()->json([
                'success' => false,
                'message' => 'Fishpedia entry not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Fishpedia entry retrieved successfully',
            'data' => $fishpedia
        ], 200);
    }

    /**
     * Memperbarui data Fishpedia berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $fishpedia = Fishpedia::find($id);
        if (!$fishpedia) {
            return response()->json([
                'success' => false,
                'message' => 'Fishpedia entry not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'asal' => 'sometimes|required|string|max:255',
            'jenis' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'nama' => 'sometimes|required|string|max:255',
            'id_ikan' => 'sometimes|required|integer',
            'harga_pasar' => 'sometimes|required|numeric|min:0',
            'gambar_ikan' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $fishpedia->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Fishpedia entry updated successfully',
            'data' => $fishpedia
        ], 200);
    }

    /**
     * Menghapus data Fishpedia berdasarkan ID.
     */
    public function delete($id)
    {
        $fishpedia = Fishpedia::find($id);
        if (!$fishpedia) {
            return response()->json([
                'success' => false,
                'message' => 'Fishpedia entry not found'
            ], 404);
        }

        $fishpedia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Fishpedia entry deleted successfully'
        ], 200);
    }
}
