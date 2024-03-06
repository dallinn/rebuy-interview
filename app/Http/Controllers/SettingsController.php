<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class SettingsController extends Controller {
    /**
     * Update user settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        // Validate incoming request - must be positive
        $request->validate([
            'duration' => 'required|integer|min:1'
        ]);

        // Get current user from auth 
        $user = Auth::user();

        // Retrieve the users settings or create if doesnt exist 
        $setting = Setting::firstOrCreate(
            ['user_id'  => $user->id],
            ['duration' => $request->duration] 
        );

        // Update
        $setting->duration = $request->duration;
        $setting->save();

        return response()->json([
            'message' => 'Settings updated successfully.',
            'settings' => $setting,
        ], 200);
    }
}
