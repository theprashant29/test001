<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories; 
use App\Models\SubCategories; 
use App\Models\Tasks; // Ensure this is the correct model name

class SubCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = SubCategories::with('categories')->get(); 
        $tasks = Tasks::with('subCategories')->count(); 
        // dd($categories->toArray()); // Debugging line to check categories
        // Logic to retrieve and display categories
        return view('admin.sub.index', compact('categories', 'tasks'));
    }
    public function create(Request $request)
    {
        $categories = Categories::all(); // Fetch all categories for the dropdown
        return view('admin.sub.create', compact('categories'));
    }
    public function store(Request $request)
    {
        // Logic to store a new category
        // Validate and save the category data

        $request->validate([
            'category_id' => 'required|integer|max:10',
            'name' => 'required|string|max:255',
        ]);

        SubCategories::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('sub-categories.index')->with('success', 'Category created successfully.');
    }
   
    public function edit($id)
    {
        $subcategory = SubCategories::findOrFail($id);
        $categories = Categories::all();

        return view('admin.sub.edit', compact('subcategory', 'categories'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
             'category_id' => 'required|integer|max:10',
            'name' => 'required|string|max:255',
        ]);
        $SubCategories = SubCategories::findOrFail($id);
        $SubCategories->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('sub-categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('sub-categories.index')->with('success', 'Category deleted successfully.');
    }
}
