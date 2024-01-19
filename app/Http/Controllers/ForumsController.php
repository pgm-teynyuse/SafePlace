<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{
    public function index()
    {
        $forums = Forum::orderBy('created_at', 'desc')->paginate(10);

        return view('forums.list', ['forums' => $forums]);
    }

    public function create()
    {
        return view('forums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
        ]);

        $user_id = Auth::id();

        Forum::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $user_id,
        ]);

        return redirect('/forums?success=forum-created');
    }

    public function detail($id)
    {
        $forum = Forum::findOrFail($id);

        return view('forums.detail', ['forum' => $forum]);
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
