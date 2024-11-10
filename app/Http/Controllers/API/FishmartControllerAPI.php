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
        try {
            $produk = Produk::all()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_produk' => $item->nama_produk,
                    'deskripsi_produk' => $item->deskripsi_produk,
                    // Generate URL lengkap untuk gambar
                    'gambar_produk' => $item->gambar_produk ? asset('storage/' . $item->gambar_produk) : null,
                    'stok' => $item->stok,
                    'harga' => $item->harga,
                    'kategori' => $item->kategori,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'All products retrieved successfully',
                'data' => $produk
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving products: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'gambar_produk' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Ubah validasi untuk file upload
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string|in:Filter Air,Pakan,Tanaman Hias,Batu Coral,Aquascape',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Handle file upload
            $gambarPath = null;
            if ($request->hasFile('gambar_produk')) {
                $gambarPath = $request->file('gambar_produk')->store('produk', 'public');
            }

            $produk = Produk::create([
                'nama_produk' => $request->nama_produk,
                'deskripsi_produk' => $request->deskripsi_produk,
                'gambar_produk' => $gambarPath,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'kategori' => $request->kategori,
            ]);

            // Return dengan URL gambar lengkap
            $produk->gambar_produk = $gambarPath ? asset('storage/' . $gambarPath) : null;

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $produk
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating product: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $produk = Produk::find($id);

            if (!$produk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Generate URL lengkap untuk gambar
            $produk->gambar_produk = $produk->gambar_produk ? 
                asset('storage/' . $produk->gambar_produk) : null;

            return response()->json([
                'success' => true,
                'message' => 'Product retrieved successfully',
                'data' => $produk
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving product: ' . $e->getMessage()
            ], 500);
        }
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
