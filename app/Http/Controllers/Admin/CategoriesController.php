<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories; 

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::all(); 
        // dd($category); // Debugging line to check categories
        
        // Logic to retrieve and display categories
        return view('admin.categories.index', compact('categories'));
    }
    public function create(Request $request)
    {
        // Logic to show the form for creating a new category
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        // Logic to store a new category
        // Validate and save the category data

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categories::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    public function edit(Request $request, $id)
    {
        $cat = Categories::findOrFail($id);
        return view('admin.categories.edit', compact('cat'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Categories::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
