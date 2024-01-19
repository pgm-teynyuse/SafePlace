<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Category;
use App\Models\Blog;
use App\Models\FormReply;
use App\Http\Controllers\BadWordsController;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
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
    public function index()
    {
        $queryBuilder = Forum::query()->orderBy('created_at', 'desc');

        return view('forums.list', ['forums' => $queryBuilder->paginate(10)
    ]);
    }

        public function create()
        {

            $categories = Category::all();

            return view('forums.create', ['categories' => $categories]);
        }

public function store(Request $request)
{
    // Validatie van de request
    $request->validate([
        'title' => 'required|min:3|max:255',
        'body' => 'required|min:3|max:10000',
        'category_id' => 'required',
    ]);

    $body = $request->input('body');
    if ($this->checkForBadWords($body)) {
        return redirect()->back()->withErrors(['body' => 'De inhoud van het bericht is niet toegestaan.']);
    }

        $user_id = Auth::id();

        $forum = new Forum();
        $forum->title = $request->input('title');
        $forum->body = $body;
        $forum->category_id = $request->input('category_id');
        $forum->user_id = $user_id;
        $forum->save();

        return redirect('/forums?success=forum-created');
    }

    public function detail($id)
        {
            $forum = Forum::findOrFail($id);
            $replies = FormReply::where('form_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            $relatedBlogs = Blog::where('category_id', $forum->category_id)
                            ->latest()
                            ->take(3)
                            ->get();

            return view('forums.detail', ['forum' => $forum, 'relatedBlogs' => $relatedBlogs, 'replies' => $replies]);
        }

    public function delete($id)
    {
        $forum = Forum::findOrFail($id);

        $forum->delete();

        return redirect('/forums?success=forum-deleted');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
        ]);

        $forum = Forum::findOrFail($id);

        $forum->title = $request->input('title');
        $forum->description = $request->input('description');

        $forum->save();

        return redirect('/forums?success=forum-updated');
    }

    public function edit($id)
    {
        $forum = Forum::findOrFail($id);

        return view('forums.edit', ['forum' => $forum]);
    }

}
