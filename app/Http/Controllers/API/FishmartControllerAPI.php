<?php

namespace App\Http\Controllers\API;

use App\Models\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FishmartControllerAPI extends Controller
{
    /**
     * Mendapatkan semua data produk.
     */
    public function index()
    {
        $produk = Produk::all(); // Mengambil semua data produk

        return response()->json([
            'success' => true,
            'message' => 'All products retrieved successfully',
            'data' => $produk
        ], 200);
    }

    /**
     * Membuat data produk baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'gambar_produk' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string|in:Filter Air,Pakan,Tanaman Hias,Batu Coral,Aquascape', // Validasi kategori
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Membuat data produk
        $produk = Produk::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $produk
        ], 201);
    }

    /**
     * Mendapatkan data produk berdasarkan ID.
     */
    public function show($id)
    {
        $produk = Produk::find($id); // Mencari data produk berdasarkan ID

        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $produk
        ], 200);
    }

    /**
     * Memperbarui data produk berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_produk' => 'sometimes|required|string|max:255',
            'deskripsi_produk' => 'sometimes|required|string',
            'gambar_produk' => 'sometimes|required|string|max:255',
            'stok' => 'sometimes|required|integer|min:0',
            'harga' => 'sometimes|required|numeric|min:0',
            'kategori' => 'sometimes|required|string|in:Filter Air,Pakan,Tanaman Hias,Batu Coral,Aquascape', // Validasi kategori untuk update
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $produk->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $produk
        ], 200);
    }

    /**
     * Menghapus data produk berdasarkan ID.
     */
    public function delete($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
