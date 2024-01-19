<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfessionalsController extends Controller
{
    public function index() {
            
            $queryBuilder = Professional::query()->orderBy('first_name');

            return view('professionals.list', [
                'professionals' => $queryBuilder->paginate(10)
            ]);
    }

    public function detail($id) {
        $professional = Professional::find($id);

    if(! isset($professional->id) ) {

            return redirect('/professionals?error=professional-not-found');
        }


        return view ('professionals.detail', [
            'professional' => $professional,
        ]);
    }
}

