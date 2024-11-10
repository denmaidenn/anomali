<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\FormUser;

class FeedbackControllerAPI extends Controller
{
    // Retrieve all feedback entries
    public function index()
    {
        $feedbacks = Feedback::with('user')->get();
        return response()->json([
            'success'=> true,
            'message' => 'All Feedbacks retrieved successfully',
            'data'=> $feedbacks
        ]);
    }

    // Store new feedback entry, linked to FormUser
    public function store(Request $request)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        // Check if user is authenticated
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json(['error' => 'Anda harus login untuk memberikan feedback.'], 401);
        }

        // Create feedback with authenticated FormUser's ID
        $feedback = Feedback::create([
            'user_id' => $user->id, // Use FormUser's ID
            'komentar' => $request->komentar,
        ]);

        return response()->json(['success' => true, 'feedback' => $feedback]);
    }

    // Show a single feedback entry
    public function show($id)
    {
        $feedback = Feedback::with('user')->find($id);

        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }

        return response()->json($feedback);
    }

    // Update an existing feedback entry
    public function update(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }

        $feedback->update([
            'komentar' => $request->komentar,
        ]);

        return response()->json(['success' => true, 'feedback' => $feedback]);
    }

    // Delete a feedback entry
    public function delete($id)
    {
        $feedback = Feedback::find($id);

        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }

        $feedback->delete();

        return response()->json(['success' => true, 'message' => 'Feedback deleted successfully']);
    }
}