<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;

class ParticipantsController extends Controller
{
    public function create($activityId)
    {
        return view('activities.participate', ['activityId' => $activityId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
        ]);

        $user_id = Auth::id();
        $activity_id = $request->input('activity_id');

        // Check if the user is already participating
        $existingParticipant = Participant::where('user_id', $user_id)
            ->where('activity_id', $activity_id)
            ->first();

        if ($existingParticipant) {
            return redirect()->back()->with('error', 'You are already participating in this activity.');
        }

        // Create a new participant record
        Participant::create([
            'user_id' => $user_id,
            'activity_id' => $activity_id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success', 'You have successfully participated in the activity.');
    }
}
