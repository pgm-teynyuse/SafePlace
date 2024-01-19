<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public function index() {

        $queryBuilder = Question::query()->orderBy('created_at');

        return view('questions.list', [
            'questions' => $queryBuilder->paginate(10)
        ]);
    }

}

