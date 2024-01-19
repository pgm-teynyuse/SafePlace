<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ActivitiesController extends Controller
{
    public function index() {

        $queryBuilder = Activity::query()->orderBy('title');

        return view('activities.list', [
            'activities' => $queryBuilder->paginate(10)
        ]);
    }

    public function detail($id) {
        $activity = Activity::find($id);

        if(! isset($activity->id) ) {

            return redirect('/activities?error=activity-not-found');
        }

        return view ('activities.detail', [
            'activity' => $activity,
        ]);
    }    

    public function create(){

        return view('activities.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|',
            'image_url' => 'required|min:3|',
            'start_date' => 'required|min:3|',
            'end_date' => 'required|min:3|',
            'max_participants' => 'required|',
            'min_participants' => 'required|',
            'location' => 'required|min:3|',

        ]);

        $user_id = Auth::id();

        $activity = new Activity();
        $activity->title = $request->input('title');
        $activity->description = $request->input('description');
        $activity->image_url = $request->input('image_url');
        $activity->start_date = $request->input('start_date');
        $activity->end_date = $request->input('end_date');
        $activity->max_participants = $request->input('max_participants');
        $activity->min_participants = $request->input('min_participants');
        $activity->location = $request->input('location');
        $activity->user_id = $user_id;
        $activity->save();

        return redirect('/activities?success=activity-created');
    }

    public function edit($id) {
        $activity = Activity::find($id);

        if(! isset($activity->id) ) {

            return redirect('/activities?error=activity-not-found');
        }

        return view ('activities.edit', [
            'activity' => $activity,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => '|min:3|max:255',
            'description' => '|min:3|',
            'image_url' => '|min:3|',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'max_participants' => '|max:20|',
            'min_participants' => '|max:3|',
            'location' => '|max:255|',

        ]);

        $activity = Activity::find($id);

        if(! isset($activity->id) ) {

            return redirect('/activities?error=activity-not-found');
        }

        $activity->title = $request->input('title');
        $activity->description = $request->input('description');
        $activity->image_url = $request->input('image_url');

    if ($request->has('start_date')) {
        $activity->start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->toDateString();
    }
    if ($request->has('end_date')) {
        $activity->end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->toDateString();
    }
    
        $activity->max_participants = $request->input('max_participants');
        $activity->min_participants = $request->input('min_participants');
        $activity->location = $request->input('location');
        $activity->save();

        return redirect('/activities?success=activity-updated');
    }

    public function delete($id) {
        $activity = Activity::find($id);

        if(! isset($activity->id) ) {

            return redirect('/activities?error=activity-not-found');
        }

        $activity->delete();

        return redirect('/activities?success=activity-deleted');
    }

    

    
}