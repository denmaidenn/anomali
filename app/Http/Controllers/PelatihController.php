<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use Illuminate\Http\Request;

class PelatihController extends Controller
{
    // Display a listing of the Pelatih.
    public function index()
    {
        $pelatih = Pelatih::all();
        return view('pelatih.index', compact('pelatih'), ['title' => 'Pelatih']);
    }

    // Show the form for creating a new Pelatih.
    public function create()
    {
        return view('pelatih.create', ['title' => 'Pelatih']);
    }

    // Store a newly created Pelatih in the database.
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelatih,email',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255'
        ]);

        Pelatih::create($request->all());
        return redirect()->route('pelatih.index')->with('success', 'Pelatih berhasil ditambahkan.');
    }

    // Display the specified Pelatih.
    public function show($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('pelatih.show', compact('pelatih'), ['title' => 'Pelatih']);
    }

    // Show the form for editing the specified Pelatih.
    public function edit($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        return view('pelatih.edit', compact('pelatih'), ['title' => 'Pelatih']);
    }

    // Update the specified Pelatih in the database.
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelatih,email,' . $id,
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:255'
        ]);

        $pelatih = Pelatih::findOrFail($id);
        $pelatih->update($request->all());
        return redirect()->route('pelatih.index')->with('success', 'Pelatih berhasil diperbarui.');
    }

    // Remove the specified Pelatih from the database.
    public function destroy($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        $pelatih->delete();
        return redirect()->route('pelatih.index')->with('success', 'Pelatih berhasil dihapus.');
    }
}
