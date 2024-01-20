<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormReply;
use Illuminate\Support\Facades\Auth;

class FormRepliesController extends Controller
{
    protected $badWords = [];

    public function __construct() {
        $this->badWords = json_decode(file_get_contents(resource_path('data/badwords.json')), true);
    }

    public function checkForBadWords($text) {
        foreach ($this->badWords as $badWord) {
            if (stripos($text, $badWord) !== false) {
                return true;
            }
        }
        return false; 
    }

    public function create()
    {
        return view('forms.create');
    }

public function store(Request $request, $forumId)
    {
        $request->validate([
            'body' => 'required|min:3|max:255',
        ]);

    $body = $request->input('body');
    if ($this->checkForBadWords($body)) {
        return redirect()->back()->withErrors(['body' => 'De inhoud van het bericht is niet toegestaan.']);
    }

        $reply = new FormReply();
        $reply->body = $request->input('body');
        $reply->user_id = Auth::id();
        $reply->form_id = $forumId;
        $reply->save();

        return redirect()->route('forums.detail', ['id' => $forumId])
            ->with('success', 'Antwoord toegevoegd');
    }
}
