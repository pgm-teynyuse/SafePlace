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

public function index(Request $request)
{
    // Default sort is "Nieuw"
    $sort = $request->query('sort', 'newest');

    $query = Forum::withCount('replies'); // Dit zal een 'replies_count' attribuut toevoegen aan elk forum model

    // Sorteren op basis van het aantal reacties
    if ($sort === 'popular') {
        $query->orderByDesc('replies_count');
    } elseif ($sort === 'oldest') {
        $query->orderBy('created_at');
    } else {
        $query->orderByDesc('created_at'); // Default sort: Nieuw
    }

    // Filteren op categorie indien geselecteerd
    $category_id = $request->query('category_id');
    if ($category_id) {
        $query->where('category_id', $category_id);
    }

    $forums = $query->paginate(10);
    $categories = Category::all();

    return view('forums.list', ['forums' => $forums, 'categories' => $categories]);
}


        public function create()
        {

            $categories = Category::all();

            return view('forums.create', ['categories' => $categories]);
        }

public function store(Request $request)
{
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

    public function myForums()
    {
        $user_id = Auth::id();

        $forums = Forum::where('user_id', $user_id)
                    ->orderByDesc('created_at')
                    ->paginate(10);

        return view('dashboard.forums', ['forums' => $forums]);
    }

public function edit($id)
{
    $forum = Forum::findOrFail($id);
    $categories = Category::all();

    return view('dashboard.edit', ['forum' => $forum, 'categories' => $categories]);
}

public function update(Request $request, $id)
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

    $forum = Forum::findOrFail($id);
    $forum->title = $request->input('title');
    $forum->body = $body;
    $forum->category_id = $request->input('category_id');
    $forum->save();

    return redirect('/forums?success=forum-updated');
}

public function delete($id)
{
    $forum = Forum::findOrFail($id);
    $forum->delete();

    return redirect('/forums?success=forum-deleted');
}


        public function filterByCategory($category_id) {
        $queryBuilder = Forum::where('category_id', $category_id)->orderBy('created_at', 'desc');
        $categories = Category::all();
        $forum = $queryBuilder->paginate(10);

        return view('forums.list', ['forums' => $forum, 'categories' => $categories]);
    }

    public function search(Request $request) {
        $query = $request->get('query');
        $forum = Forum::where('title', 'like', '%' . $query . '%')
                    ->orWhere('body', 'like', '%' . $query . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $categories = Category::all();

        return view('forums.list', ['forums' => $forum, 'categories' => $categories]);
    }

}
