<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\FormUser; // Import FormUser model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        // Load all feedback entries with associated user data
        $feedback = Feedback::with('user')->get();
        return view('feedback.index', ['title' => 'Feedback', 'feedback' => $feedback]);
    }

    public function create()
    {
        // Load feedback creation view
        $formuser = FormUser::all();
        return view('feedback.create', ['title' => 'Feedback', 'formuser'=> $formuser]);
    }

    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'user_id' => 'required|exists:form_users,id',
            'komentar' => 'required|string|max:1000',
        ]);
            // Create feedback with the authenticated user's ID
            Feedback::create([
                'user_id' => $validatedData['user_id'],
                'komentar' => $validatedData['komentar'],
            ]);

            return redirect()->route('feedback.index')->with('success', 'Feedback berhasil ditambahkan!');
    
    }

    public function edit($id)
    {
        // Find feedback by ID for editing
        $feedback = Feedback::findOrFail($id);
        $formusers = FormUser::all();

        return view('feedback.edit', compact('feedback', 'formusers'), ['title' => 'Feedback']);
    }

    public function update(Request $request, $id)
    {
        // Find the feedback entry by ID
        $feedback = Feedback::findOrFail($id);

        // Validate updated data
        $validatedData = $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        // Update the feedback entry
        $feedback->update([
            'komentar' => $validatedData['komentar'],
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Find and delete the feedback entry
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus!');
    }

    public function show($id)
    {
        $feedback = Feedback::with('user')->findOrFail($id); // Pastikan ada relasi `user` untuk mengambil data user terkait
        return view('feedback.show', compact('feedback'), ['title' => 'Feedback']);
    }
    
}
