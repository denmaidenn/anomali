<?php

namespace App\Http\Controllers;
<<<<<<< Updated upstream

use App\Models\Fish;
use Illuminate\Container\Attributes\Auth;
=======
use App\Models\Fish; // Pastikan ini ada
>>>>>>> Stashed changes
use Illuminate\Http\Request;

class FishpediaController extends Controller
{
    public function index() {
<<<<<<< Updated upstream
        $fish = Fish::all();
        return view('fishpedia.index', ['title' => 'Fishpedia', 'fish'=> $fish]);
=======
        $Fish = Fish::all(); // Mengambil semua data ikan
        return view('Fish.index', compact('Fish')); // Mengirim data ikan ke view
    }

    public function show($id) {
        $fish = Fish::find($id); // Mengambil detail ikan berdasarkan ID
        return view('FishPedia.Fish', compact('Fish')); // Mengirimkan data ikan ke view
>>>>>>> Stashed changes
    }

    public function tambahikan_page() {
        return view('fishpedia.tambahikan', ['title'=> 'Tambah Ikan']);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'scientific_name' => 'required',
            'category' => 'required',
            'origin' => 'required',
            'size' => 'required',
            'characteristics' => 'required',
            'aquarium_size' => 'required',
            'temperature' => 'required',
            'ph' => 'required',
            'salinity' => 'required',
            'lighting' => 'required',
        ]);

        Fish::create([
            'name' => $request->name,
            'scientific_name' => $request->scientific_name,
            'category' => $request->category,
            'origin' => $request->origin,
            'size' => $request->size,
            'characteristics' => $request->characteristics,
            'aquarium_size' => $request->aquarium_size,
            'temperature' => $request->temperature,
            'ph' => $request->ph,
            'salinity' => $request->salinity,
            'lighting' => $request->lighting,
        ]);

        return redirect('/fishpedia')->with('success', 'Data ikan berhasil ditambahkan!');
    }

    public function edit($id) {
        $fish = Fish::findOrFail($id);  // Mencari ikan berdasarkan ID
        return view('fishpedia.edit_fish', ['title' => 'Edit Ikan', 'fish' => $fish]);
    }


    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'scientific_name' => 'required',
            'category' => 'required',
            'origin' => 'required',
            'size' => 'required',
            'characteristics' => 'required',
            'aquarium_size' => 'required',
            'temperature' => 'required',
            'ph' => 'required',
            'salinity' => 'required',
            'lighting' => 'required',
        ]);

        $fish = Fish::findOrFail($id);  // Cari ikan berdasarkan ID
        $fish->update([
            'name' => $request->name,
            'scientific_name' => $request->scientific_name,
            'category' => $request->category,
            'origin' => $request->origin,
            'size' => $request->size,
            'characteristics' => $request->characteristics,
            'aquarium_size' => $request->aquarium_size,
            'temperature' => $request->temperature,
            'ph' => $request->ph,
            'salinity' => $request->salinity,
            'lighting' => $request->lighting,
        ]);

        return redirect('/fishpedia')->with('success', 'Data ikan berhasil diperbarui!');
    }


    public function destroy($id) {
        $fish = Fish::findOrFail($id);  // Mencari ikan berdasarkan ID
        $fish->delete();  // Menghapus data ikan
        return redirect('/fishpedia')->with('success', 'Data ikan berhasil dihapus!');
    }


}
