<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;

/**
 * Pomodoro Session
 */
class SessionsController extends Controller
{
    /* Start a pomodoro session */
    public function start(Request $request) {
        // Validate incoming request
        $request->validate([
            'description' => 'nullable|string|max:255',
        ]);
    
        // Create new session
        $session = new Session;
        $session->user_id = Auth::id();
        $session->description = $request->input('description', '');
        $session->start_time = now();
        $session->save();
    
        // Return 201 and the new session
        return response()->json([
            'message' => 'Session started',
            'session' => $session,
        ], 201);

    }
    
    /* Stop a pomodoro session */
    public function stop(Request $request) {
        // Validate incoming request
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
        ]);
    
        // Find a session from request's session_id
        $session = Session::where('id', $request->session_id)
                          ->where('user_id', Auth::id())
                          ->first();
    
        // Could not find session
        if (!$session) {
            return response()->json(['message' => 'Session not found.'], 404);
        }
    
        // End the session
        $session->end_time = now();
        $session->save();
    
        // Return 200 and the stopped session
        return response()->json([
            'message' => 'Session stopped',
            'session' => $session,
        ], 200);
    }

    /* Retreive history for a pomodoro session */
    public function history(Request $request) {
        // Find all sessions that the auth'd user has
        $sessions = Session::where('user_id', auth()->id())->orderBy('start_time', 'desc')->get();

        // Return history
        return response()->json([
            'sessions' => $sessions,
        ], 200);
    }
}
