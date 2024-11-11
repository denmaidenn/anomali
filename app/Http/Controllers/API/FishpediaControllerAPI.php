<?php

namespace App\Http\Controllers\API;

use App\Models\Fishpedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
        // Validasi input sesuai dengan kolom yang ada pada model Fishpedia
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nama_ilmiah' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'ukuran' => 'required|string|max:255',
            'karakteristik' => 'required|string',
            'akuarium' => 'required|string|max:255',
            'suhu_ideal' => 'required|numeric',
            'ph_air' => 'required|numeric',
            'salinitas' => 'required|string|max:255',
            'pencahayaan' => 'required|string|max:255',
            'gambar_ikan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // jika ada gambar ikan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar_ikan')) {
            $gambarPath = $request->file('gambar_ikan')->store('fishpedia', 'public');
        }

        // Membuat data fishpedia
        $fishpedia = Fishpedia::create([
            'nama' => $request->nama,
            'nama_ilmiah' => $request->nama_ilmiah,
            'kategori' => $request->kategori,
            'asal' => $request->asal,
            'ukuran' => $request->ukuran,
            'karakteristik' => $request->karakteristik,
            'akuarium' => $request->akuarium,
            'suhu_ideal' => $request->suhu_ideal,
            'ph_air' => $request->ph_air,
            'salinitas' => $request->salinitas,
            'pencahayaan' => $request->pencahayaan,
            'gambar_ikan' => $gambarPath,
        ]);

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
            'nama' => 'sometimes|required|string|max:255',
            'nama_ilmiah' => 'sometimes|required|string|max:255',
            'kategori' => 'sometimes|required|string|max:255',
            'asal' => 'sometimes|required|string|max:255',
            'ukuran' => 'sometimes|required|string|max:255',
            'karakteristik' => 'sometimes|required|string',
            'akuarium' => 'sometimes|required|string|max:255',
            'suhu_ideal' => 'sometimes|required|numeric',
            'ph_air' => 'sometimes|required|numeric',
            'salinitas' => 'sometimes|required|string|max:255',
            'pencahayaan' => 'sometimes|required|string|max:255',
            'gambar_ikan' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan gambar baru jika diunggah
        if ($request->hasFile('gambar_ikan')) {
            // Hapus gambar lama dari storage jika ada
            if ($fishpedia->gambar_ikan) {
                Storage::disk('public')->delete($fishpedia->gambar_ikan);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar_ikan')->store('fishpedia', 'public');
            $fishpedia->gambar_ikan = $gambarPath;
        }

        // Update data lainnya
        $fishpedia->update($request->only([
            'nama','nama_ilmiah', 'kategori', 'asal', 'ukuran', 'karakteristik', 'akuarium',
            'suhu_ideal', 'ph_air', 'salinitas', 'pencahayaan'
        ]));

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

        // Hapus gambar dari storage jika ada
        if ($fishpedia->gambar_ikan) {
            Storage::disk('public')->delete($fishpedia->gambar_ikan);
        }

        $fishpedia->delete();

        return response()->json([
            'success' => true,
            'message' => 'Fishpedia entry deleted successfully'
        ], 200);
    }
}
