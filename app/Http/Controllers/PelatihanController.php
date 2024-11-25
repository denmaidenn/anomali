<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihan = Pelatihan::with('user')->get();
        return view('pelatihan.index', ['title' => 'Pelatihan', 'pelatihan' => $pelatihan]);
    }

    public function create()
    {
        $pelatih = Pelatih::all(); // Ambil semua pelatih
        return view('pelatihan.create', ['title' => 'Pelatihan', 'pelatih' => $pelatih]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'id_user' => 'required|exists:pelatih,id',
            'judul' => 'required|string|max:255',
            'video_pelatihan' => 'required|file|mimes:mp4,avi,mkv|max:102400',  // max 20MB
            'gambar_pelatihan' => 'nullable|file|image|max:2048', // max 2MB
            'deskripsi_pelatihan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        // Handle video upload
        $videoPath = $request->file('video_pelatihan')->store('videos_pelatihan', 'public');
        
        // Handle image upload if present
        $gambarPath = null;
        if ($request->hasFile('gambar_pelatihan')) {
            $gambarPath = $request->file('gambar_pelatihan')->store('pelatihan', 'public');
        }

        // Store the data
        Pelatihan::create([
            'id_user' => $validatedData['id_user'],
            'judul' => $validatedData['judul'],
            'video_pelatihan' => $videoPath,
            'gambar_pelatihan' => $gambarPath,
            'deskripsi_pelatihan' => $validatedData['deskripsi_pelatihan'],
            'harga' => $validatedData['harga'],
        ]);

        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatih = Pelatih::all();

        return view('pelatihan.edit', compact('pelatihan', 'pelatih'), ['title' => 'Pelatihan']);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'id_user' => 'required|exists:pelatih,id',
            'judul' => 'required|string|max:255',
            'video_pelatihan' => 'nullable|file|mimes:mp4,avi,mkv|max:102400',  // max 20MB
            'gambar_pelatihan' => 'nullable|file|image|max:2048', // max 2MB
            'deskripsi_pelatihan' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        // Find the Pelatihan to update
        $pelatihan = Pelatihan::findOrFail($id);

        // Handle video upload if a new video is uploaded
        if ($request->hasFile('video_pelatihan')) {
            $videoPath = $request->file('video_pelatihan')->store('videos_pelatihan', 'public');
            $pelatihan->video_pelatihan = $videoPath;
        }

        // Handle image upload if a new image is uploaded
        if ($request->hasFile('gambar_pelatihan')) {
            $gambarPath = $request->file('gambar_pelatihan')->store('pelatihan', 'public');
            $pelatihan->gambar_pelatihan = $gambarPath;
        }

        // Update other fields
        $pelatihan->id_user = $validatedData['id_user'];
        $pelatihan->judul = $validatedData['judul'];
        $pelatihan->deskripsi_pelatihan = $validatedData['deskripsi_pelatihan'];
        $pelatihan->harga = $validatedData['harga'];
        
        // Save the updates
        $pelatihan->save();

        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->delete();
        return redirect()->route('pelatihan.index')->with('success', 'Pelatihan berhasil dihapus');
    }

    public function show($id)
    {
        $pelatihan = Pelatihan::with('user')->findOrFail($id);
        return view('pelatihan.show', compact('pelatihan'), ['title' => 'Pelatihan']);
    }

    public function viewcheckout() {
        // Load all feedback entries with associated user data
        $pelatihan = Pelatihan::all();
        return view('checkout.pelatihan', ['title' => 'Checkout', 'pelatihan' => $pelatihan]);
    }
}
