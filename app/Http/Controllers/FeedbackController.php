<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //

    public function index() {
        $feedback = Feedback::all();
        return view('feedback.index', ['title' => 'Fishmart', 'produk'=> $feedback]);
    }

    public function create () {
        return view('feedback.create', ['title' => 'Fishmart']);
    }

    public function store(Request $request)
    {
        // Validate the feedback input
        $validatedData = $request->validate([
            'komentar' => 'required|string',
        ]);
    
        // Ensure the user is authenticated before proceeding
        if (auth()->check()) {
            // Save the feedback to the database
            Feedback::create([
                'komentar' => $request->komentar,
                'user_id' => auth()->id(), // assuming feedback is tied to a logged-in user
            ]);
    
            return redirect()->route('feedback.index')->with('success', 'Feedback berhasil ditambahkan!');
        } else {
            return redirect()->route('feedback.index')->with('error', 'Anda harus login untuk memberikan feedback.');
        }
    }

    // Update feedback
    public function update(Request $request, $id)
    {
        // Find the feedback by ID
        $feedback = Feedback::find($id);

        // Validate input, ensure only komentar is updated
        $request->validate([
            'komentar' => 'required|string',
        ]);

        // Update the feedback comment
        $feedback->update([
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui!');
    }

    public function show($id)
{
    // Find the feedback by its ID
    $feedback = Feedback::findOrFail($id);  // Will automatically throw a 404 if not found

    // Return the feedback details view, passing the feedback data
    return view('feedback.show', [
        'title' => 'Feedback Details',
        'feedback' => $feedback
    ]);
}


    // Delete feedback
    public function delete($id)
    {
        // Find feedback by ID
        $feedback = Feedback::find($id);

        if ($feedback) {
            $feedback->delete();
            return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
        } else {
            return redirect()->route('feedback.index')->with('error', 'Feedback tidak ditemukan.');
        }
    }

}
