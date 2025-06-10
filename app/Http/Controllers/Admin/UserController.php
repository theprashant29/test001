<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Tasks; 
class UserController extends Controller
{
    public function index(Request $request)
    {
$users = User::with('tasks')->withCount('tasks')->get();
        // dd($users->toArray()); 
        return view('admin.user.index', compact('users'));
    }
    public function create(Request $request)
    {
        $categories = Categories::all(); // Fetch all categories for the dropdown
        $subCategories = SubCategories::all(); // Fetch all subcategories for the dropdown
        return view('admin.user.create', compact('categories', 'subCategories'));
    }
    public function store(Request $request)
    {
        // Logic to store a new user
        // Validate and save the user data

       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);
        
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);
        
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
    
}
