<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FormUser; // Import FormUser model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index() {
        $feedback = Feedback::with('user')->get(); // Ensure 'user' relationship is set to FormUser in Feedback model
        return view('feedback.index', ['title' => 'Fishmart', 'produk'=> $feedback]);
    }

    public function create() {
        return view('feedback.create', ['title' => 'Fishmart']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'komentar' => 'required|string',
        ]);

        // Ensure the user is authenticated before proceeding
        if (auth()->check()) {
            Feedback::create([
                'komentar' => $request->komentar,
                'user_id' => auth()->guard('sanctum')->id(), // Use correct guard if needed
            ]);

            return redirect()->route('feedback.index')->with('success', 'Feedback berhasil ditambahkan!');
        } else {
            return redirect()->route('feedback.index')->with('error', 'Anda harus login untuk memberikan feedback.');
        }
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $request->validate([
            'komentar' => 'required|string',
        ]);

        $feedback->update([
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui!');
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);

        return view('feedback.show', [
            'title' => 'Feedback Details',
            'feedback' => $feedback,
        ]);
    }

    public function delete($id)
    {
        $feedback = Feedback::find($id);

        if ($feedback) {
            $feedback->delete();
            return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
        } else {
            return redirect()->route('feedback.index')->with('error', 'Feedback tidak ditemukan.');
        }
    }
}
