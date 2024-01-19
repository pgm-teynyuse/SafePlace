<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormReply;
use Illuminate\Support\Facades\Auth;

class FormRepliesController extends Controller
{
    public function create()
    {
        return view('forms.create');
    }

public function store(Request $request, $forumId)
    {
        $request->validate([
            'body' => 'required|min:3|max:255',
        ]);

        $reply = new FormReply();
        $reply->body = $request->input('body');
        $reply->user_id = Auth::id();
        $reply->form_id = $forumId;
        $reply->save();

        return redirect()->route('forums.detail', ['id' => $forumId])
            ->with('success', 'Antwoord toegevoegd');
    }
}
