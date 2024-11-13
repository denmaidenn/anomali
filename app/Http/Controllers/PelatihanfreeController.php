<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use App\Models\PelatihanFree;
use Illuminate\Http\Request;

class PelatihanfreeController extends Controller
{
    //

    public function index()
    {
        $pelatihan = PelatihanFree::with('user')->get();
        return view('pelatihanfree.index', ['title' => 'Pelatihan', 'pelatihan' => $pelatihan]);
    }

    public function create()
    {
        $pelatih = Pelatih::all(); // Ambil semua pelatih
        return view('pelatihanfree.create', ['title' => 'Pelatihan', 'pelatih' => $pelatih]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'id_user' => 'required|exists:pelatih,id',
            'judul' => 'required|string|max:255',
            'video_pelatihan' => 'required|file|mimes:mp4,avi,mkv|max:20480',  // max 20MB
            'gambar_pelatihan' => 'nullable|file|image|max:2048', // max 2MB
            'deskripsi_pelatihan' => 'required|string',
        ]);

        // Handle video upload
        $videoPath = $request->file('video_pelatihan')->store('videos_pelatihanfree', 'public');
        
        // Handle image upload if present
        $gambarPath = null;
        if ($request->hasFile('gambar_pelatihan')) {
            $gambarPath = $request->file('gambar_pelatihan')->store('pelatihanfree', 'public');
        }

        // Store the data
        PelatihanFree::create([
            'id_user' => $validatedData['id_user'],
            'judul' => $validatedData['judul'],
            'video_pelatihan' => $videoPath,
            'gambar_pelatihan' => $gambarPath,
            'deskripsi_pelatihan' => $validatedData['deskripsi_pelatihan'],
        ]);

        return redirect()->route('pelatihanfree.index')->with('success', 'Pelatihan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelatihan = PelatihanFree::findOrFail($id);
        $pelatih = Pelatih::all();

        return view('pelatihanfree.edit', compact('pelatihan', 'pelatih'), ['title' => 'Pelatihan']);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'id_user' => 'required|exists:pelatih,id',
            'judul' => 'required|string|max:255',
            'video_pelatihan' => 'nullable|file|mimes:mp4,avi,mkv|max:20480',  // max 20MB
            'gambar_pelatihan' => 'nullable|file|image|max:2048', // max 2MB
            'deskripsi_pelatihan' => 'required|string',
        ]);

        // Find the Pelatihan to update
        $pelatihan = PelatihanFree::findOrFail($id);

        // Handle video upload if a new video is uploaded
        if ($request->hasFile('video_pelatihan')) {
            $videoPath = $request->file('video_pelatihan')->store('videos_pelatihanfree', 'public');
            $pelatihan->video_pelatihan = $videoPath;
        }

        // Handle image upload if a new image is uploaded
        if ($request->hasFile('gambar_pelatihan')) {
            $gambarPath = $request->file('gambar_pelatihan')->store('pelatihanfree', 'public');
            $pelatihan->gambar_pelatihan = $gambarPath;
        }

        // Update other fields
        $pelatihan->id_user = $validatedData['id_user'];
        $pelatihan->judul = $validatedData['judul'];
        $pelatihan->deskripsi_pelatihan = $validatedData['deskripsi_pelatihan'];
        
        // Save the updates
        $pelatihan->save();

        return redirect()->route('pelatihanfree.index')->with('success', 'Pelatihan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelatihan = PelatihanFree::findOrFail($id);
        $pelatihan->delete();
        return redirect()->route('pelatihanfree.index')->with('success', 'Pelatihan berhasil dihapus');
    }

    public function show($id)
    {
        $pelatihan = PelatihanFree::with('user')->findOrFail($id);
        return view('pelatihanfree.show', compact('pelatihan'), ['title' => 'Pelatihan']);
    }
}
