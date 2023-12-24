<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    
}