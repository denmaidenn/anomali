<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelatihControllerAPI extends Controller
{
    // Display a listing of Pelatih.
    public function index()
    {
        $pelatih = Pelatih::all();
        return response()->json(['data' => $pelatih], 200);
    }

    // Store a newly created Pelatih in the database.
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelatih,email',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pelatih = Pelatih::create($request->all());
        return response()->json(['data' => $pelatih, 'message' => 'Pelatih berhasil ditambahkan'], 201);
    }

    // Display the specified Pelatih.
    public function show($id)
    {
        $pelatih = Pelatih::find($id);
        if (!$pelatih) {
            return response()->json(['message' => 'Pelatih tidak ditemukan'], 404);
        }
        return response()->json(['data' => $pelatih], 200);
    }

    // Update the specified Pelatih in the database.
    public function update(Request $request, $id)
    {
        $pelatih = Pelatih::find($id);
        if (!$pelatih) {
            return response()->json(['message' => 'Pelatih tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelatih,email,' . $id,
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pelatih->update($request->all());
        return response()->json(['data' => $pelatih, 'message' => 'Pelatih berhasil diperbarui'], 200);
    }

    // Remove the specified Pelatih from the database.
    public function delete($id)
    {
        $pelatih = Pelatih::find($id);
        if (!$pelatih) {
            return response()->json(['message' => 'Pelatih tidak ditemukan'], 404);
        }

        $pelatih->delete();
        return response()->json(['message' => 'Pelatih berhasil dihapus'], 200);
    }
}
