<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\FormUser;
use Illuminate\Support\Facades\Log;

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
        // Ambil data Feedback dengan relasi ke FormUser
        $feedback = Feedback::with('user')->find($id);
    
        // Periksa apakah feedback ditemukan
        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback not found'
            ], 404);
        }
    
        // Ambil data pengguna lainnya (jika diperlukan)
        $users = FormUser::all(['id', 'name']); // Ambil semua pengguna untuk dropdown atau pilihan lainnya
    
        // Kembalikan data feedback beserta data pengguna
        return response()->json([
            'success' => true,
            'message' => 'Feedback retrieved successfully',
            'data' => $feedback,
            'users' => $users,  // Menambahkan data pengguna lainnya
        ], 200);
    }
    

    // Update an existing feedback entry
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'komentar' => 'required|string|max:1000',
            'user_id' => 'required|exists:form_users,id', // Validasi user_id
        ]);
    
        // Find the feedback record by its ID
        $feedback = Feedback::find($id);
    
        // Check if the feedback exists
        if (!$feedback) {
            return response()->json(['error' => 'Feedback not found'], 404);
        }
    
        // Update the feedback
        $feedback->update([
            'komentar' => $request->komentar,
            'user_id' => $request->user_id,  // Update user_id
        ]);
    
        // Return a success response with updated feedback data
        return response()->json([
            'success' => true,
            'message' => 'Feedback updated successfully',
            'feedback' => $feedback,
        ]);
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
