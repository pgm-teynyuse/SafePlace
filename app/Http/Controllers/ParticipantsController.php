<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;

class ParticipantsController extends Controller
{
    public function index(){
        $queryBuilder = Participant::query()->orderBy('created_at');

        return view('dashboard.activities', ['participants' => $queryBuilder->paginate(10)]);
    }

    public function create($activityId)
    {
        return view('activities.participate', ['activityId' => $activityId]);
    }

    public function store(Request $request)
{
    $request->validate([
        'activity_id' => 'required|exists:activities,id',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
    ]);

    $activity_id = $request->input('activity_id');
    $user_id = Auth::id();

    if ($user_id) {
        // Check if the logged-in user is already participating
        $existingParticipant = Participant::where('user_id', $user_id)
            ->where('activity_id', $activity_id)
            ->first();

        if ($existingParticipant) {
            return redirect()->back()->with('error', 'You are already participating in this activity.');
        }
    } else {
        // Check if a non-logged in user with the same email is already participating
        $existingParticipant = Participant::where('email', $request->input('email'))
            ->where('activity_id', $activity_id)
            ->first();

        if ($existingParticipant) {
            return redirect()->back()->with('error', 'This email is already registered for the activity.');
        }
    }

    // Create a new participant record
    Participant::create([
        'user_id' => $user_id, // This will be null for non-logged in users
        'activity_id' => $activity_id,
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
    ]);

    return redirect()->back()->with('success', 'You have successfully participated in the activity.');
}
}
