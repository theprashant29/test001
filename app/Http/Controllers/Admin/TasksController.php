<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;
use App\Models\SubCategories;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Tasks::with('user')->latest()->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $subcategories = SubCategories::all();
        return view('admin.tasks.create', compact('users', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'user_id' => 'required|exists:users,id',
             'sub_id' => 'required|exists:sub_categories,id',
            'option1' => 'nullable|string',
            'option2' => 'nullable|string',
            'option3' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'description', 'user_id','sub_id', 'option1', 'option2', 'option3']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tasks', 'public');
        }

        Tasks::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Tasks::findOrFail($id);
        $users = User::all();
        $subcategories = SubCategories::all();
        return view('admin.tasks.edit', compact('task', 'users', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'user_id' => 'required|exists:users,id',
            'option1' => 'nullable|string',
            'option2' => 'nullable|string',
            'option3' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'description', 'user_id', 'option1', 'option2', 'option3']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tasks', 'public');
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
