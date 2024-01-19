<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        return view('categories.list', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/categories?success=category-created');
    }

    public function detail($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.detail', ['category' => $category]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect('/categories?success=category-deleted');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->input('name');

        $category->save();

        return redirect('/categories?success=category-updated');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', ['category' => $category]);
    }

}
