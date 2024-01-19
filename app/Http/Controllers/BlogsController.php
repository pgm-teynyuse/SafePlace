<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    
    public function index() {

        $queryBuilder = Blog::query()->orderBy('title');

        return view('blogs.list', [
            'blogs' => $queryBuilder->paginate(10)
        ]);
    }

    public function detail($id) {
        $blog = Blog::find($id);


        if(! isset($blog->id) ) {

            return redirect('/blogs?error=blog-not-found');
        }


        return view ('blogs.detail', [
            'blog' => $blog,
        ]);
    }

    public function create(){
        
        $categories = Category::all();

        return view('blogs.create', ['categories' => $categories]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:3|',
            'image_url' => 'required|min:3|',
            'category_id' => 'required',

        ]);

        $user_id = Auth::id();

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->category_id = $request->input('category_id');
        $blog->image_url = $request->input('image_url');
        $blog->user_id = $user_id;
        $blog->save();

        return redirect('/blogs?success=blog-created');
    }

    public function edit($id) {
        $blog = Blog::find($id);

        if(! isset($blog->id) ) {

            return redirect('/blogs?error=blog-not-found');
        }

        return view('blogs.edit', [
            'blog' => $blog,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => '|min:3|max:255',
            'body' => '|min:3|',
            'image_url' => '|min:3|'

        ]);

        $blog = Blog::findOrFail($id);

        if(! isset($blog->id) ) {

            return redirect('/blogs?error=blog-not-found');
        }

        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->image_url = $request->input('image_url');
        $blog->save();

        return redirect('/blogs?success=blog-updated');
    }

    public function delete($id) {
        $blog = Blog::find($id);

        if(! isset($blog->id) ) {

            return redirect('/blogs?error=blog-not-found');
        }

        $blog->delete();

        return redirect('/blogs?success=blog-deleted');
    }

    public function search(Request $request) {
    $query = $request->get('query');
    $blogs = Blog::where('title', 'like', '%' . $query . '%')->get();

    return response()->json($blogs);
}
}

