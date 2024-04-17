<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::orderBy('year', 'desc')->get();
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|unique:categories,title',
            'budget' => 'required|numeric',
            'year' => 'required|integer'
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function show(Category $category) {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category) {
        $category = Category::find($category->id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'title' => 'required|unique:categories,title,'.$category->id,
            'budget' => 'required|numeric',
            'year' => 'required|integer'
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
