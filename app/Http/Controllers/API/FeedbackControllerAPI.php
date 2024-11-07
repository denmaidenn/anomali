<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

class FeedbackControllerAPI extends Controller
{
    //

    public function index()
    {
        $feedbacks = Feedback::with('user')->get();
        return response()->json($feedbacks);
    }

    // Store a new feedback entry
    public function store(Request $request)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        // Create feedback entry
        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'komentar' => $request->komentar,
        ]);

        return response()->json(['success' => true, 'feedback' => $feedback]);
    }
}
