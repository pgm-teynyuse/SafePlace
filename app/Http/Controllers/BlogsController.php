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

        $queryBuilder = Blog::query()->orderBy('created_at', 'desc');
        $categories = Category::all();

        return view('blogs.list', [
            'blogs' => $queryBuilder->paginate(10)
        ], ['categories' => $categories]);
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
        'image_url' => 'nullable|min:3|',
        'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required',
    ]);

    $user_id = Auth::id();
    
    $blog = new Blog();
    $blog->title = $request->input('title');
    $blog->body = $request->input('body');
    $blog->category_id = $request->input('category_id');
    $blog->image_url = $request->input('image_url');
    $blog->user_id = $user_id;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('uploads', $imageName, 'public');
        $blog->image = 'uploads/' . $imageName;
    }

    $blog->save();

    return redirect('/blogs?success=blog-created');
}


public function edit($id) {
    $blog = Blog::find($id);
    $categories = Category::all();

    if(!isset($blog->id)) {
        return redirect('/blogs?error=blog-not-found');
    }

    return view('blogs.edit', [
        'blog' => $blog,
        'categories' => $categories,
    ]);
}

public function update(Request $request, $id) {
    $request->validate([
        'title' => 'required|min:3|max:255',
        'body' => 'required|min:3',
        'category_id' => 'required',
    ]);

    $blog = Blog::findOrFail($id);

    $blog->title = $request->input('title');
    $blog->body = $request->input('body');
    $blog->category_id = $request->input('category_id');

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

    public function filterByCategory($category_id) {
        $queryBuilder = Blog::where('category_id', $category_id)->orderBy('created_at', 'desc');
        $categories = Category::all();
        $blogs = $queryBuilder->paginate(10);

        return view('blogs.list', ['blogs' => $blogs, 'categories' => $categories]);
    }

    public function search(Request $request) {
        $query = $request->get('query');
        $blogs = Blog::where('title', 'like', '%' . $query . '%')
                    ->orWhere('body', 'like', '%' . $query . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $categories = Category::all();

        return view('blogs.list', ['blogs' => $blogs, 'categories' => $categories]);
    }


}

