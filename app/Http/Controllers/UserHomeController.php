<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Tasks;
use App\Models\TaskUserOption;

class UserHomeController extends Controller
{
    // Display user's tasks
    public function index()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->get();

        return view('user.index', compact('tasks'));
    }

    // Store selected task options (checkboxes)
    public function storeSelectedOptions(Request $request)
    {
        $user = Auth::user();

        foreach ($request->input('options', []) as $taskId => $selectedOptions) {
            foreach ($selectedOptions as $optionValue) {
                TaskUserOption::create([
                    'task_id' => $taskId,
                    'user_id' => $user->id,
                    'option' => $optionValue,
                ]);
            }
        }

        return back()->with('success', 'Options saved successfully!');
    }
}
